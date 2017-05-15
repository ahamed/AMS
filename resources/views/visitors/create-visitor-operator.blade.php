@extends('layouts.app')
@section('title','Dashboard | Smart Appointment')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/multi-step-form.css') }}">
    <link rel="stylesheet" href="{{asset('css/required-field.css')}}">

@endsection
@section('content')
    <div class="container">
        <div class="row" style="min-height: 800px;">
            <div class="progressbar-container"></div>
            <div class="col-md-10 col-sm-10">
                <!-- multistep form -->
                <form id="msform" method="post" action="{{ url('set-visitor') }}" class="form-horizontal">
                    <!-- progressbar -->
                    {{csrf_field()}}


                    <ul id="progressbar">
                            <li class="active">Contacts</li>
                            <li>Personal Information</li>
                            <li>Appointment</li>
                        </ul>


                    <!-- fieldsets -->
                    <fieldset>

                        <h2 class="fs-title">Contact Information</h2>
                        <h3 class="fs-subtitle">Visitor's Contact information</h3>
                        <div class="form-group required-field-block">
                            <label for="mobile" class="control-label col-sm-2">Mobile</label>
                            <div class="col-sm-10">
                                <input type="text" name="mobile" id="mobile" placeholder="" class="form-control"/>
                                <div class="required-icon">
                                    <div class="text">*</div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group ">
                            <label for="mobile" class="control-label col-sm-2">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email"  id="email" placeholder="" class="form-control" />

                            </div>

                        </div>
                        <div class="form-group required-field-block">
                            <label for="address" class="control-label col-sm-2">Address</label>
                            <div class="col-sm-10">
                                <textarea name="address" id="address" rows="5" class="form-control"></textarea>
                                <div class="required-icon">
                                    <div class="text">*</div>
                                </div>
                            </div>

                        </div>
                        <input type="button" name="next" class="next action-button pull-right" value="Next" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Personal Information</h2>
                        <h3 class="fs-subtitle">visitor's personal information</h3>
                        <div class="form-group required-field-block">
                            <label for="name" class="control-label col-sm-2">Name</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" placeholder="" class="form-control"/>
                                <div class="required-icon">
                                    <div class="text">*</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required-field-block">
                            <label for="profession" class="control-label col-sm-2">Profession</label>
                            <div class="col-sm-10">
                                <input type="text" id="profession" name="profession" placeholder="" class="form-control"/>
                                <div class="required-icon">
                                    <div class="text">*</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required-field-block">
                            <label for="image" class="control-label col-sm-2">Avater</label>
                            <div class="col-sm-10">
                                <input type="file" name="image" placeholder="" class="form-control"/>

                            </div>
                        </div>

                        <input type="button" name="next" class="next action-button pull-right" value="Next" />
                        <input type="button" name="previous" class="previous action-button pull-right btn btn-danger" value="Previous" />

                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Appointment</h2>
                        <h3 class="fs-subtitle">Set appointment</h3>
                        @if(Auth::user()->role == '4')
                            <div class="form-group">
                                <label for="institute" class="control-label col-sm-2">Institute</label>
                                <div class="col-sm-10 col-md-10">
                                    <input type="text" value="{{Auth::user()->institute}}" class="form-control" disabled>
                                    <input type="hidden" name="institute" value="{{Auth::user()->institute}}" class="form-control">


                                </div>
                            </div>
                            <div class="form-group selMem" >
                                <label for="member" class="col-sm-2">Member</label>
                                <div class="col-sm-10">
                                    {{--check if the user is appointee--}}
                                    <input type="text" value="{{Auth::user()->name}}" class="form-control" disabled>
                                    <input type="hidden" name="member" value="{{Auth::user()->email}}" class="form-control">
                                </div>
                            </div>
                            <div class="appointment">
                                <div class="form-group">
                                    <label for="reference" class="control-label col-sm-2">Reference</label>
                                    <div class="col-md-10 col-sm-10">
                                        <input type="text" name="reference" id="reference" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reference" class="control-label col-sm-2">Agenda</label>
                                    <div class="col-md-10 col-sm-10">
                                        <input type="text" name="agenda" id="agenda" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Appointment Time</label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-5">
                                                <input type="datetime" class="form-control pull-right date-time" id="starts" name="starts">
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <p style="margin-top: 15px;"><strong>To</strong></p>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <input type="datetime" class="form-control pull-right date-time" id="ends" name="ends">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dtBox"></div>
                                    <!-- /.input group -->
                                </div>
                            </div>

                        @else
                            <div class="form-group">
                                <label for="institute" class="control-label col-sm-2">Institute</label>
                                <div class="col-sm-10 col-md-10">
                                    <select name="institute" id="ins" class="form-control select2" >
                                        <option value="">Select Institute/Company</option>
                                        @foreach($institutes as $ins)
                                            <option value="{{$ins->institute}}">{{$ins->institute}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group selMem" style="display:none;">
                                <label for="member" class="col-sm-2">Member</label>
                                <div class="col-sm-10">
                                    {{--check if the user is appointee--}}

                                        <select name="member" id="mem" class="select2" >
                                            <option value="">Select member</option>

                                        </select>




                                </div>
                            </div>
                            <div class="appointment" style="display: none;">
                                <div class="form-group">
                                    <label for="reference" class="control-label col-sm-2">Reference</label>
                                    <div class="col-md-10 col-sm-10">
                                        <input type="text" name="reference" id="reference" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reference" class="control-label col-sm-2">Agenda</label>
                                    <div class="col-md-10 col-sm-10">
                                        <input type="text" name="agenda" id="agenda" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Appointment Time</label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-5">
                                                <input type="datetime" class="form-control pull-right date-time" id="starts" name="starts">
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <p style="margin-top: 15px;"><strong>To</strong></p>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <input type="datetime" class="form-control pull-right date-time" id="ends" name="ends">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dtBox"></div>
                                    <!-- /.input group -->
                                </div>
                            </div>

                        @endif


                        <input type="button" name="previous" class="previous action-button btn btn-danger" value="Previous" />
                        <input type="submit" value="Submit" class="action-button "/>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/multi-part-form.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.select2').select2({
                theme: "bootstrap",
                allowClear: true,
                tags: true,
                maximumSelectionLength: 5,
                width: '100%'
            });
            var d = new Date();
            var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
            console.log(strDate);

            $('#dtBox').DateTimePicker({
                mode: "date", // date, time or datetime
                defaultDate: strDate,

                dateSeparator: "-",
                timeSeparator: ":",
                timeMeridiemSeparator: " ",
                dateTimeSeparator: " ",
                monthYearSeparator: " ",

                dateTimeFormat: "dd-MM-yyyy HH:mm",
                dateFormat: "dd-MM-yyyy",
                timeFormat: "HH:mm",

                maxDate: null,
                minDate:  null,

                maxTime: null,
                minTime: null,

                maxDateTime: null,
                minDateTime: null,

                shortDayNames: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                fullDayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                shortMonthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                fullMonthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                labels: null, /*{"year": "Year", "month": "Month", "day": "Day", "hour": "Hour", "minutes": "Minutes", "seconds": "Seconds", "meridiem": "Meridiem"}*/

                minuteInterval: 1,
                roundOffMinutes: true,

                secondsInterval: 1,
                roundOffSeconds: true,

                showHeader: true,
                titleContentDate: "Set Date",
                titleContentTime: "Set Time",
                titleContentDateTime: "Set Date & Time",

                buttonsToDisplay: ["HeaderCloseButton", "SetButton", "ClearButton"],
                setButtonContent: "Set",
                clearButtonContent: "Clear",
                incrementButtonContent: "+",
                decrementButtonContent: "-",
                setValueInTextboxOnEveryClick: false,
                readonlyInputs: false,

                animationDuration: 400,

                touchHoldInterval: 300, // in Milliseconds
                captureTouchHold: false, // capture Touch Hold Event

                mouseHoldInterval: 50, // in Milliseconds
                captureMouseHold: false, // capture Mouse Hold Event

                isPopup: true,
                parentElement: "body",

                isInline: false,
                inputElement: null,

                language: "",

                init: null, // init(oDateTimePicker)
                addEventHandlers: null,  // addEventHandlers(oDateTimePicker)
                beforeShow: null,  // beforeShow(oInputElement)
                afterShow: null,  // afterShow(oInputElement)
                beforeHide: null,  // beforeHide(oInputElement)
                afterHide: null,  // afterHide(oInputElement)
                buttonClicked: null,  // buttonClicked(sButtonType, oInputElement) where sButtonType = "SET"|"CLEAR"|"CANCEL"|"TAB"
                settingValueOfElement: null, // settingValueOfElement(sValue, dDateTime, oInputElement)
                formatHumanDate: null,  // formatHumanDate(oDateTime, sMode, sFormat)

                parseDateTimeString: null, // parseDateTimeString(sDateTime, sMode, sFormat, oInputField)
                formatDateTimeString: null // formatDateTimeString(oDateTime, sMode, sFormat, oInputField)
            });

            $('#mem').on('change',function(e){
                $('.appointment').show('slow');
            });

           $('#ins').on('change',function(e){
               e.preventDefault();
               $('.selMem').show('slow');
               var institute = $(this).val();
              // console.log(institute);
               var i = 0;
               $.ajax({
                   type: 'GET',
                   url: '/get-member-list/'+institute,
                   dataType: 'json',
                   success: function(data){
                       for( i = 0; i < Object.keys(data).length; i++){
                            $('#mem').append($('<option>',{
                                value: data[i].mobile,
                                text: data[i].name
                            }));

                       }

                   }

               });
           });


               $('#mobile').on('keyup',function(e){
                   e.preventDefault();
                   var mobile = $('#mobile').val();
                    console.log(mobile.length);

                    if(mobile.length == 11){
                        $.ajax({
                            type: 'GET',
                            url : '/get-visitor/'+mobile,
                            dataType: 'json',
                            success: function(data){
                                if(data !== null){
                                    $('#name').val(data.name);
                                    $('#email').val(data.email);
                                    $('#address').val(data.address);
                                    $('#profession').val(data.profession);
                                }else{
                                    $('#name').val('');
                                    $('#email').val('');
                                    $('#address').val('');
                                    $('#profession').val('');
                                }


                            }
                        });
                    }else{
                        $('#name').val('');
                        $('#email').val('');
                        $('#address').val('');
                        $('#profession').val('');
                    }

               });


        });
    </script>
@endsection