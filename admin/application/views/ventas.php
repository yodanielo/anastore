<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="#">Resumen de Ventas</a>
        <form class="navbar-form pull-left">
            <input type="text" class="" id="rango1" style="width:150px;">
            <input type="text" class="" id="rango2" style="width:150px">
            <button type="button" class="btn" id="btncalcular">Calcular</button>
        </form>
    </div>
</div>
<div id="chart1">

</div>
<div id="chart2">

</div>
<script type="text/javascript">
    var start;
    var end;
    accionarFechas=function(){
        //pongo el rango de fechas
        function startChange() {
            var startDate = start.value();

            if (startDate) {
                startDate = new Date(startDate);
                startDate.setDate(startDate.getDate() + 1);
                end.min(startDate);
            }
        }

        function endChange() {
            var endDate = end.value();

            if (endDate) {
                endDate = new Date(endDate);
                endDate.setDate(endDate.getDate() - 1);
                start.max(endDate);
                //aqui acciono los charts
            }
        }

        start = $("#rango1").kendoDatePicker({
            change: startChange,
            format:"dd/MM/yyyy"
        }).data("kendoDatePicker");

        end = $("#rango2").kendoDatePicker({
            change: endChange,
            format:"dd/MM/yyyy"
        }).data("kendoDatePicker");

        start.max(end.value());
        end.min(start.value());
    }
    aFecha=function(f){
        return f.getFullYear()+"-"+(f.getMonth()+1)+"-"+f.getDate()
    }
    accionarVentasDiarias=function(){
        $.ajax({
            "url":"<?= site_url("home/ventasDiarias") ?>",
            "data":"fecha1="+encodeURIComponent(aFecha(start.value()))+"&fecha2="+encodeURIComponent(aFecha(end.value())),
            "type":"post",
            "dataType":"json",
            "success":function(valores){
                $.each(valores.ejey,function(a,b){
                    valores.ejey[a]=b*1;
                })
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'chart1',
                        type: 'line',
                        marginRight: 130,
                        marginBottom: 25
                    },
                    title: {
                        text: 'Ventas Mensuales',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: valores.ejex,
                        type:"datetime"
                    },
                    yAxis: {
                        title: {
                            text: 'Total Facturado'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>'+ this.x +'</b><br/>'+
                                + this.y +'€';
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -10,
                        y: 100,
                        borderWidth: 0
                    },
                    series: [{
                            name: 'Monto facturado',
                            data: valores.ejey
                        }],
                    credits:{
                        enabled:false
                    }
                });
            }
        });
    }
    accionarProductos=function(){
        $.ajax({
            "url":"<?= site_url("home/productos") ?>",
            "data":"fecha1="+encodeURIComponent(aFecha(start.value()))+"&fecha2="+encodeURIComponent(aFecha(end.value())),
            "type":"post",
            "dataType":"json",
            "success":function(valores){
                $.each(valores.ejey,function(a,b){
                    valores.ejey[a]=b*1;
                })
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'chart2',
                        type: 'column',
                        marginRight: 130,
                        marginBottom: 25
                    },
                    title: {
                        text: 'Ventas Mensuales',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: valores.ejex
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad Vendida'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>'+ this.x +'</b><br/>'+
                                + this.y +' vendidos';
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -10,
                        y: 100,
                        borderWidth: 0
                    },
                    series: [{
                            name: 'Productos<br/>más<br/>vendidos',
                            data: valores.ejey
                        }],
                    credits:{
                        enabled:false
                    }
                });
            }
        });
    }
    accionarCharts=function(){
        if(start && end){   
            accionarVentasDiarias()
            accionarProductos()
        }
    }
    $(function(){
        accionarFechas()
        $("#btncalcular").click(accionarCharts);
    })
</script>
