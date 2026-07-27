@extends('layouts.app')

@section('customer_name', $username)

@section('brand_name', $BrandName)

@section('content')



    <head>

        <link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">

        <meta charset="UTF-8">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    </head>

    <div class="card mb-4">

        <div class="card-header">

            {{ $data['form_title'] }}

        </div>



        <div class="card-body">



            @if ($data['form_title'] == 'Add New Contact')
                <form method="POST" action="{{ route('contacts.store') }}" enctype="multipart/form-data">

                    @csrf
                @else
                    <form method="POST" action="{{ route('contacts.update', $contact->id) }}"
                        enctype="multipart/form-data">

                        @csrf

                        @method('PUT')
            @endif

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="branch_name">Branch Name:</label>

                        <input type="text" name="branch_name"
                            value="{{ old('branch_name') ? old('branch_name') : ($contact ? $contact->branch_name : '') }}"
                            class="form-control" placeholder="branch_name" required>

                        @error('branch_name')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group">

                        <label for="address">Address:</label>

                        <input type="text" name="address"
                            value="{{ old('address') ? old('address') : ($contact ? $contact->address : '') }}"
                            class="form-control" placeholder="address" required>

                        @error('address')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group">

                        <label for="phone">Phone:</label>

                        <input type="phone" name="phone"
                            value="{{ old('phone') ? old('phone') : ($contact ? $contact->phone : '') }}"
                            class="form-control" placeholder="phone" required>

                        @error('phone')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group">

                        <label for="email">Email:</label>

                        <input type="email" name="email"
                            value="{{ old('email') ? old('email') : ($contact ? $contact->email : '') }}"
                            class="form-control" placeholder="email" required>

                        @error('email')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group">

                        <label for="map">Map:</label>

                        <textarea class="form-control" name="map" id="exampleFormControlTextarea1" placeholder="map" rows="3"
                            required>{{ old('map', $contact ? $contact->map : '') }}</textarea>

                        <small class="form-text text-muted fw-bold">
                            Please Enter a MAP with <span class="text-danger">iframe tag From Google Map</span>
                        </small>

                        @error('map')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>



                <div class="container">

                    <table class="table table-borderless">

                        <thead>

                            <tr>

                                <th scope="col">Day</th>

                                <th scope="col">Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <!-- Sunday -->

                            <tr>

                                <td>Sunday</td>

                                <td>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input sundayRadio" type="radio" name="sundayStatus"
                                            id="sundayRadioClose" value="close"
                                            {{ old('sundayStatus', optional($contact)->time_status) == '0' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="sundayRadioClose">Close</label>

                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input sundayRadio" type="radio" name="sundayStatus"
                                            id="sundayRadioOpen" value="open"
                                            {{ old('sundayStatus', optional($contact)->time_status) == '1' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="sundayRadioOpen">Open</label>

                                    </div>



                                    <div class="row">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="sundaytextBox" name="sunday_to"
                                                placeholder="To"
                                                value="{{ old('sunday_to', $contact ? $contact->sunday_to : '') }}"
                                                @if (old('sundayStatus', optional($contact)->sundayStatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="sundayfrombox" name="sunday_from"
                                                placeholder="From"
                                                value="{{ old('sunday_from', $contact ? $contact->sunday_from : '') }}"
                                                @if (old('sundayStatus', optional($contact)->sundayStatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                            <!-- Monday -->

                            <tr>

                                <td>Monday</td>

                                <td>

                                    <div class="form-check form-check-inline">


                                        <input class="form-check-input mondayRadio" type="radio" name="mondayStatus"
                                            id="mondayRadioClose" value="close"
                                            {{ old('mondayStatus', optional($contact)->mondayStatus) == '0' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="mondayRadioClose">Close</label>

                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input mondayRadio" type="radio" name="mondayStatus"
                                            id="mondayRadioOpen" value="open"
                                            {{ old('mondayStatus', optional($contact)->mondayStatus) == '1' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="mondayRadioOpen">Open</label>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="mondaytextBox"
                                                name="monday_to" placeholder="To"
                                                value="{{ old('monday_to', $contact ? $contact->monday_to : '') }}"
                                                @if (old('mondayStatus', optional($contact)->mondayStatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="mondayfrombox"
                                                name="monday_from" placeholder="From"
                                                value="{{ old('monday_from', $contact ? $contact->monday_from : '') }}"
                                                @if (old('mondayStatus', optional($contact)->mondayStatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>Tuesday</td>

                                <td>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input tuesdayRadio" type="radio" name="Tuesdaystatus"
                                            id="Tuesdayclose" value="close"
                                            {{ old('Tuesdaystatus', optional($contact)->Tuesdaystatus) == '0' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="Tuesdayclose">Close</label>

                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input tuesdayRadio" type="radio" name="Tuesdaystatus"
                                            id="Tuesdayopen" value="open"
                                            {{ old('Tuesdaystatus', optional($contact)->Tuesdaystatus) == '1' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="Tuesdayopen">Open</label>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="TuesdaytextBox"
                                                name="tuesday_to" placeholder="To"
                                                value="{{ old('tuesday_to', $contact ? $contact->tuesday_to : '') }}"
                                                @if (old('Tuesdaystatus', optional($contact)->Tuesdaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="Tuesdayfrombox"
                                                name="tuesday_from" placeholder="From"
                                                value="{{ old('tuesday_from', $contact ? $contact->tuesday_from : '') }}"
                                                @if (old('Tuesdaystatus', optional($contact)->Tuesdaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                    </div>

                                </td>

                            </tr>



                            <tr>

                                <td>Wednesday</td>

                                <td>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input wednesdayRadio" type="radio"
                                            name="Wednesdaystatus" id="Wednesdayclose" value="close"
                                            {{ old('Wednesdaystatus', optional($contact)->Wednesdaystatus) == '0' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="Wednesdayclose">Close</label>

                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input wednesdayRadio" type="radio"
                                            name="Wednesdaystatus" id="Wednesdayopen" value="open"
                                            {{ old('Wednesdaystatus', optional($contact)->Wednesdaystatus) == '1' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="Wednesdayopen">Open</label>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="WednesdaytextBox"
                                                name="wednesday_to" placeholder="To"
                                                value="{{ old('wednesday_to', $contact ? $contact->tuesday_to : '') }}"
                                                @if (old('Wednesdaystatus', optional($contact)->Wednesdaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="Wednesdayfrombox"
                                                name="wednesday_from" placeholder="From"
                                                value="{{ old('wednesday_from', $contact ? $contact->wednesday_from : '') }}"
                                                @if (old('Wednesdaystatus', optional($contact)->Wednesdaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                    </div>

                                </td>

                            </tr>



                            <tr>

                                <td>Thursday</td>

                                <td>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input thursdayRadio" type="radio"
                                            name="Thursdaystatus" id="Thursdayclose" value="close"
                                            {{ old('Thursdaystatus', optional($contact)->Thursdaystatus) == '0' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="Thursdayclose">Close</label>

                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input thursdayRadio" type="radio"
                                            name="Thursdaystatus" id="Thursdayopen" value="open"
                                            {{ old('Thursdaystatus', optional($contact)->Thursdaystatus) == '1' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="Thursdayopen">Open</label>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="ThursdaytextBox"
                                                name="thursday_to" placeholder="To"
                                                value="{{ old('thursday_to', $contact ? $contact->tuesday_to : '') }}"
                                                @if (old('Thursdaystatus', optional($contact)->Thursdaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="Thursdayfrombox"
                                                name="thursday_from" placeholder="From"
                                                value="{{ old('thursday_from', $contact ? $contact->thursday_from : '') }}"
                                                @if (old('Thursdaystatus', optional($contact)->Thursdaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                    </div>

                                </td>

                            </tr>



                            <tr>

                                <td>Friday</td>

                                <td>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input fridayRadio" type="radio" name="fridaystatus"
                                            id="fridayclose" value="close"
                                            {{ old('fridaystatus', optional($contact)->fridaystatus) == '0' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="fridayclose">Close</label>

                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input fridayRadio" type="radio" name="fridaystatus"
                                            id="fridayopen" value="open"
                                            {{ old('fridaystatus', optional($contact)->fridaystatus) == '1' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="fridayopen">Open</label>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="FridaytextBox"
                                                name="friday_to" placeholder="To"
                                                value="{{ old('friday_to', $contact ? $contact->tuesday_to : '') }}"
                                                @if (old('fridaystatus', optional($contact)->fridaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="Fridayfrombox"
                                                name="friday_from" placeholder="From"
                                                value="{{ old('friday_from', $contact ? $contact->thursday_from : '') }}"
                                                @if (old('fridaystatus', optional($contact)->fridaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                    </div>

                                </td>

                            </tr>



                            <tr>

                                <td>Saturday</td>

                                <td>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input saturdayRadio" type="radio"
                                            name="Saturdaystatus" id="Saturdayclose" value="close"
                                            {{ old('Saturdaystatus', optional($contact)->Saturdaystatus) == '0' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="Saturdayclose">Close</label>

                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input saturdayRadio" type="radio"
                                            name="Saturdaystatus" id="Saturdayopen" value="open"
                                            {{ old('Saturdaystatus', optional($contact)->Saturdaystatus) == '1' ? 'checked' : '' }}>

                                        <label class="form-check-label" for="Saturdayopen">Open</label>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="SaturdaytextBox"
                                                name="saturday_to" placeholder="To"
                                                value="{{ old('saturday_to', $contact ? $contact->tuesday_to : '') }}"
                                                @if (old('Saturdaystatus', optional($contact)->Saturdaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" id="Saturdayfrombox"
                                                name="saturday_From" placeholder="From"
                                                value="{{ old('saturday_From', $contact ? $contact->thursday_from : '') }}"
                                                @if (old('Saturdaystatus', optional($contact)->Saturdaystatus) !== 'open') style="display: none;" @endif>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="col-12 mt-2 text-center">

                <button type="submit" class="btn Submit_btn">Submit</button>

            </div>

            </form>

        </div>

    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {


        function toggleTextBoxes(radioValue, textBox, frombox) {

            if (radioValue === "open") {

                textBox.show();

                frombox.show();

            } else {

                textBox.hide();

                frombox.hide();

            }

        }


        var $sundayTextBox = $("#sundaytextBox");
        var $sundayFromBox = $("#sundayfrombox");

        $(".sundayRadio").on("change", function() {
            var selectedValue = $(this).val();

            if (selectedValue === "close") {
                // If 'Close' is selected, hide elements
                $sundayTextBox.hide();
                $sundayFromBox.hide();
            } else if (selectedValue === "open") {
                // If 'Open' is selected, show elements
                $sundayTextBox.show();
                $sundayFromBox.show();
            }
        });

        // Set initial state based on the value of old('sundayStatus', optional($contact)->time_status)
        var initialStatus = '{{ old('sundayStatus', optional($contact)->time_status) }}';
        if (initialStatus === '0') {
            // If initial status is '0', set 'Close' radio button as checked
            $("#sundayRadioClose").prop('checked', true);
            // Hide elements
            $sundayTextBox.hide();
            $sundayFromBox.hide();
        } else if (initialStatus === '1') {
            // If initial status is '1', set 'Open' radio button as checked
            $("#sundayRadioOpen").prop('checked', true);
            // Show elements
            $sundayTextBox.show();
            $sundayFromBox.show();
        }

        $(".mondayRadio").on("change", function() {
            toggleTextBoxes($(this).val(), $("#mondaytextBox"), $("#mondayfrombox"));
        });

        // Set Initial State for Monday
        var initialMondayStatus = '{{ old('mondayStatus', optional($contact)->mondayStatus) }}';
        if (initialMondayStatus === '0') {
            // If initial status is '0', set 'Close' radio button as checked
            $("#mondayRadioClose").prop('checked', true);
            // Hide elements
            $("#mondaytextBox").hide();
            $("#mondayfrombox").hide();
        } else if (initialMondayStatus === '1') {
            // If initial status is '1', set 'Open' radio button as checked
            $("#mondayRadioOpen").prop('checked', true);
            // Show elements
            $("#mondaytextBox").show();
            $("#mondayfrombox").show();
        }

        var $tuesdayTextBox = $("#TuesdaytextBox");
        var $tuesdayFromBox = $("#Tuesdayfrombox");

        $(".tuesdayRadio").on("change", function() {
            toggleTextBoxes($(this).val(), $tuesdayTextBox, $tuesdayFromBox);
        });

        // Set initial state based on the value of old('Tuesdaystatus', optional($contact)->Tuesdaystatus)
        var initialTuesdayStatus = '{{ old('Tuesdaystatus', optional($contact)->Tuesdaystatus) }}';
        if (initialTuesdayStatus === '0') {
            $("#Tuesdayclose").prop('checked', true);
            $tuesdayTextBox.hide();
            $tuesdayFromBox.hide();
        } else if (initialTuesdayStatus === '1') {
            $("#Tuesdayopen").prop('checked', true);
            $tuesdayTextBox.show();
            $tuesdayFromBox.show();
        }

        var $WednesdayTextBox = $("#WednesdaytextBox");
        var $WednesdayFromBox = $("#Wednesdayfrombox");

        $(".wednesdayRadio").on("change", function() {
            toggleTextBoxes($(this).val(), $WednesdayTextBox, $WednesdayFromBox);
        });

        // Set initial state based on the value of old('Wednesdaystatus', optional($contact)->Wednesdaystatus)
        var initialWednesdayStatus = '{{ old('Wednesdaystatus', optional($contact)->Wednesdaystatus) }}';
        if (initialWednesdayStatus === '0') {
            $("#Wednesdayclose").prop('checked', true);
            $WednesdayTextBox.hide();
            $WednesdayFromBox.hide();
        } else if (initialWednesdayStatus === '1') {
            $("#Wednesdayopen").prop('checked', true);
            $WednesdayTextBox.show();
            $WednesdayFromBox.show();
        }


        var $ThursdayTextBox = $("#ThursdaytextBox");
        var $ThursdayFromBox = $("#Thursdayfrombox");

        $(".thursdayRadio").on("change", function() {
            var selectedValue = $(this).val();
            toggleTextBoxes(selectedValue, $ThursdayTextBox, $ThursdayFromBox);
        });

        // Set initial state based on the value of old('Thursdaystatus', optional($contact)->Thursdaystatus)
        var initialThursdayStatus = '{{ old('Thursdaystatus', optional($contact)->Thursdaystatus) }}';
        if (initialThursdayStatus === '0') {
            // If initial status is '0', set 'Close' radio button as checked
            $("#Thursdayclose").prop('checked', true);
            // Hide elements
            $ThursdayTextBox.hide();
            $ThursdayFromBox.hide();
        } else if (initialThursdayStatus === '1') {
            // If initial status is '1', set 'Open' radio button as checked
            $("#Thursdayopen").prop('checked', true);
            // Show elements
            $ThursdayTextBox.show();
            $ThursdayFromBox.show();
        }


        var $fridayTextBox = $("#FridaytextBox");
        var $fridayFromBox = $("#Fridayfrombox");

        $(".fridayRadio").on("change", function() {
            toggleTextBoxes($(this).val(), $fridayTextBox, $fridayFromBox);
        });

        // Set initial state based on the value of old('fridaystatus', optional($contact)->fridaystatus)
        var initialFridayStatus = '{{ old('fridaystatus', optional($contact)->fridaystatus) }}';
        if (initialFridayStatus === '0') {
            // If initial status is '0', set 'Close' radio button as checked
            $("#fridayclose").prop('checked', true);
            // Hide elements
            $fridayTextBox.hide();
            $fridayFromBox.hide();
        } else if (initialFridayStatus === '1') {
            // If initial status is '1', set 'Open' radio button as checked
            $("#fridayopen").prop('checked', true);
            // Show elements
            $fridayTextBox.show();
            $fridayFromBox.show();
        }
        var $saturdayTextBox = $("#SaturdaytextBox");
        var $saturdayFromBox = $("#Saturdayfrombox");

        $(".saturdayRadio").on("change", function() {
            toggleTextBoxes($(this).val(), $saturdayTextBox, $saturdayFromBox);
        });

        // Set initial state for Saturday based on the value of old('Saturdaystatus', optional($contact)->Saturdaystatus)
        var initialSaturdayStatus = '{{ old('Saturdaystatus', optional($contact)->Saturdaystatus) }}';
        if (initialSaturdayStatus === '0') {
            $("#Saturdayclose").prop('checked', true);
            $saturdayTextBox.hide();
            $saturdayFromBox.hide();
        } else if (initialSaturdayStatus === '1') {
            $("#Saturdayopen").prop('checked', true);
            $saturdayTextBox.show();
            $saturdayFromBox.show();
        }

        // Function to toggle text boxes based on radio button value
        function toggleTextBoxes(value, textBox, fromBox) {
            if (value === "close") {
                textBox.hide();
                fromBox.hide();
            } else if (value === "open") {
                textBox.show();
                fromBox.show();
            }
        }



    });
</script>
