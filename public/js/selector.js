$(document).ready(function(){
    /*$('.selectpicker').selectpicker({
        style: 'btn-primary',
        size: 13
    });*/

    var reportType, st, selval, year, month;
    var link;
    link = document.getElementById("deo").getAttribute("data-addrs");
    console.log("link url : " + link);

    $('.criteria').on('change',function(){



        $('.month').hide();
        $('.year').hide();
        $('.status').hide();

        $('#hd th').remove();
        $('#tbd tr').remove();

        //select the index 0
        $('#month').prop('selectedIndex',0);
        $('#year').prop('selectedIndex',0);
        $('#mystatus').prop('selectedIndex',0);


         reportType = $(this).val();
         st = "all";
         selval = "today";
         year = null;
         month = null;




        /*Daily report*/

        if(reportType == "daily"){

            $('#month').prop('selectedIndex',0);
            $('#year').prop('selectedIndex',0);
            $('#mystatus').prop('selectedIndex',0);

            $('#hd th').remove();
            $('#tbd tr').remove();

            $('.status').show('slow');
            selval = "today";
            st = "all";
            getByAjax(reportType,selval,st,link);
            $('#mystatus').on('change',function(){
               st = $(this).val();
               getByAjax(reportType,selval,st,link);
            });


        }

        /*Monthly report*/

        else if(reportType == "monthly"){


            //select the index 0
            $('#month').prop('selectedIndex',0);
            $('#year').prop('selectedIndex',0);
            $('#mystatus').prop('selectedIndex',0);


            $('.month').show('slow');
            $('.status').hide('slow');
            $('.year').hide('slow');

            $('#month').on('change',function(){

                $('#year').prop('selectedIndex',0);
                $('#mystatus').prop('selectedIndex',0);

                $('.status').show('slow');
                $('#hd th').remove();
                $('#tbd tr').remove();

                month = $(this).val();
                selval = month;
                st = 'all';
                getByAjax(reportType,selval,st,link);
                $('#mystatus').on('change',function(){
                    st = $(this).val();
                    getByAjax(reportType,selval,st,link);
                });

            });

        }
        else if(reportType == "yearly"){



            //select the index 0
            $('#month').prop('selectedIndex',0);
            $('#year').prop('selectedIndex',0);
            $('#mystatus').prop('selectedIndex',0);

            $('.status').hide('slow');
            $('.year').show('slow');

            $('.month').hide('slow');


            $('#year').on('change',function(){

                $('#month').prop('selectedIndex',0);
                $('#mystatus').prop('selectedIndex',0);
                $('.status').show('slow');
                $('#hd th').remove();
                $('#tbd tr').remove();


                year = $(this).val();
                selval = year;
                st = 'all';
                getByAjax(reportType,selval,st,link);
                $('#mystatus').on('change',function(){
                    st = $(this).val();
                    getByAjax(reportType,selval,st,link);
                });

            });
        }


    });

});

var formatTime = function(date){
    var hour = date.getHours();
    var minute = date.getMinutes();
    var A;
    if(hour > 12){
        hour = hour - 12;
        A = "PM";
    }else{
        A = "AM";
    }

    if(minute<10){
        minute = "0"+minute;
    }

    var time = hour+":"+minute+" "+A;
    return time;



};

var getByAjax = function(reportType,selval,st,link){
    var i = 0;
    $.ajax({
        type: 'GET',
        url: '/'+link+'/'+reportType+'/'+selval+'/'+st,
        dataType:'json',
        success: function(data){
            console.log("Length: "+ Object.keys(data).length);
            $('#hd th').remove();
            $('#tbd tr').remove();

            if(Object.keys(data).length > 0){
                $('#hd').append($('<th>',{
                    text: '#'
                }));
                $('#hd').append($('<th>',{
                    text: 'Visitor'
                }));
                $('#hd').append($('<th>',{
                    text: 'Appointee'
                }));
                $('#hd').append($('<th>',{
                    text: 'Reference'
                }));
                $('#hd').append($('<th>',{
                    text: 'Agenda'
                }));
                $('#hd').append($('<th>',{
                    text: 'Address'
                }));
                $('#hd').append($('<th>',{
                    text: 'Appointment Time'
                }));
                $('#hd').append($('<th>',{
                    text: 'Status'
                }));
            }

            for(i = 0; i < Object.keys(data).length; i++){
                var alertString = "";

                if(data[i].status == 'pending'){
                    alertString = "alert alert-warning";

                }else if(data[i].status == 'rejected'){
                    alertString = "alert alert-danger";
                }else {
                    alertString = "alert alert-success";
                }



                $('#tbd').append(
                    $('<tr>',{class: 'ttr'})
                        .append($('<td>',{text: (i+1)}))
                        .append($('<td>',{text:data[i].visitor_name}))
                        .append($('<td>',{text:data[i].name}))
                        .append($('<td>',{text:data[i].reference}))
                        .append($('<td>',{text:data[i].agendas}))
                        .append($('<td>',{text:data[i].address}))
                        .append($('<td>',{text: formatTime(new Date(data[i].starts)) + ' to ' + formatTime(new Date(data[i].ends))}))
                        .append($('<td>',{text:data[i].status,class: alertString}))
                );



            }
        }
    });
};


