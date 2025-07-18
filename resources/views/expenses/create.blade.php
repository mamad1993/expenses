<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Tracker</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --secondary: #f3f4f6;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --white: #ffffff;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f9fafb;
            color: var(--text-dark);
            line-height: 1.5;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: var(--white);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        h1 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--text-dark);
            background-color: var(--white);
            background-clip: padding-box;
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
        }

        .form-select {
            display: block;
            width: 100%;
            padding: 0.75rem 2.25rem 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--text-dark);
            background-color: var(--white);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            appearance: none;
        }

        .form-select:focus {
            border-color: var(--primary);
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
        }

        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.375rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            cursor: pointer;
        }

        .btn-primary {
            color: var(--white);
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.75rem;
            margin-left: -0.75rem;
        }

        .col {
            flex: 1 0 0%;
            padding-right: 0.75rem;
            padding-left: 0.75rem;
        }

        .col-12 {
            flex: 0 0 auto;
            width: 100%;
            padding-right: 0.75rem;
            padding-left: 0.75rem;
        }

        .col-md-6 {
            padding-right: 0.75rem;
            padding-left: 0.75rem;
        }

        @media (min-width: 768px) {
            .col-md-6 {
                flex: 0 0 auto;
                width: 50%;
            }
        }

        .icon-input {
            position: relative;
        }

        .icon-input i {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .icon-input input {
            padding-left: 2.5rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 9999px;
        }

        .status-paid {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-unpaid {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .status-due {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .submit-container {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .loading {
            display: none;
            margin-left: 0.5rem;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.375rem;
            display: none;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Expense Tracker</h1>

    <div id="successAlert" class="alert alert-success">
        Expense successfully saved!
    </div>

    <div class="form">
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="title">Title</label>
                <div class="icon-input">
                    <i class="fas fa-heading"></i>
                    <input type="text" class="form-control" placeholder="Enter title" name="title" id="title">
                </div>
            </div>

            <div class="col-md-6 form-group">
                <label for="category_id">Category</label>
                <select name="category" id="category_id" class="form-select">
                    <option value="5">ابزار</option>
                    <option value="1">شهرداری و اداری</option>
                    <option value="2">نقشه و طراحی</option>
                    <option value="3">لوله‌کشی و تأسیسات</option>
                    <option value="4">خوراکی و پذیرایی و کمک</option>
                    <option value="6">کارگر و استادکار</option>
                    <option value="7">نقاشی و رنگ‌آمیزی</option>
                    <option value="8">متفرقه</option>
                    <option value="9">خاکبرداری و مصالح</option>
                </select>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6 form-group">
                <label for="amount">Amount</label>
                <div class="icon-input">
                    <i class="fas fa-dollar-sign"></i>
                    <input type="text" class="form-control" placeholder="Enter amount" id="amount">
                </div>
            </div>

            <div class="col-md-6 form-group">
                <label for="date">Date</label>
                <div class="icon-input">
                    <i class="fas fa-calendar"></i>
                    <input type="text" class="form-control" id="date" placeholder="Select date">
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6 form-group">
                <label for="role_id">role</label>
                <select name="role" id="role_id" class="form-select">
                    <option value="0">select</option>
                    <option value="1">رزاق</option>
                    <option value="2">جوشکار موید</option>

                </select>
            </div>

            <div class="col-md-6 form-group">
                <label for="type">Payment Status</label>
                <select name="type" id="type" class="form-select">
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="due">Due</option>
                </select>
            </div>
        </div>

        {{--<div class="row">
            <div class="col-md-6 form-group">
                <label for="type">Payment Status</label>
                <select name="type" id="type" class="form-select">
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="due">Due</option>
                </select>
            </div>

            <div class="col-md-6 form-group">
                <label for="hours">Hours</label>
                <div class="icon-input">
                    <i class="fas fa-clock"></i>
                    <input type="text" name="hours" class="form-control" placeholder="Enter number of hours" id="hours">
                </div>
            </div>
        </div>--}}

        <div class="form-group">
            <label for="note">Notes</label>
            <textarea name="note" id="note" class="form-control" placeholder="Add any additional notes here..."></textarea>
        </div>


        <div class="form-group">
            <label for="">Upload Image</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">

        </div>


        <div class="submit-container">
            <button type="button" id="submitBtn" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Expense
                <i class="fas fa-spinner loading" id="loadingSpinner"></i>
            </button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize date picker
        flatpickr("#date", {
            dateFormat: "Y-m-d",
            defaultDate: new Date()
        });

        // Form submission
        $('#submitBtn').on('click', function(e) {
            e.preventDefault();

            // Show loading spinner
            $('#loadingSpinner').css('display', 'inline-block');

            let formData = new FormData();
            formData.append('title', $('#title').val());
            formData.append('category_id', $('#category_id').val());
            formData.append('amount', $('#amount').val());
            formData.append('type', $('#type').val());
            formData.append('role_id', $('#role_id').val());
            formData.append('note', $('#note').val());
            formData.append('date', $('#date').val());

            let image = $('#image')[0].files[0];
            if(image){
                formData.append('image', image);

            }
            $.ajax({
                url: '{{ route("add_expense") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:formData,
                processData: false, // Required for FormData
                contentType: false,
                success: function(response) {
                    // Hide loading spinner
                    $('#loadingSpinner').css('display', 'none');

                    // Show success message
                    $('#successAlert').fadeIn().delay(3000).fadeOut();

                    console.log('response', response.message);

                    // Clear form fields
                    $('#title').val('');
                    $('#amount').val('');
                    $('#note').val('');
                    $('#image').val('');

                },
                error: function(xhr, status, error) {
                    // Hide loading spinner
                    $('#loadingSpinner').css('display', 'none');
                    console.error('Error:', error);
                }
            });
        });

        // Add status badge display when changing type
        $('#type').on('change', function() {
            let statusValue = $(this).val();
            let statusClass = 'status-' + statusValue;

            // Update visual feedback based on selection
            $(this).removeClass('status-paid status-unpaid status-due')
                .addClass(statusClass);
        });
    });
</script>
{{--<script>
    $(document).ready(function() {
        // Initialize date picker
        flatpickr("#date", {
            dateFormat: "Y-m-d",
            defaultDate: new Date()
        });

        // Form submission
        $('#submitBtn').on('click', function(e) {
            e.preventDefault();

            // Show loading spinner
            $('#loadingSpinner').css('display', 'inline-block');

            let formData = new FormData();
            formData.append('title', $('#title').val());
            formData.append('category_id', $('#category_id').val());
            formData.append('amount', $('#amount').val());
            formData.append('type', $('#type').val());
            formData.append('role_id', $('#role_id').val());
            formData.append('note', $('#note').val());
            formData.append('date', $('#date').val());
            $.ajax({
                url: '{{ route("add_expense") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    title: $('#title').val(),
                    category_id: $('#category_id').val(),
                    amount: $('#amount').val(),
                    type: $('#type').val(),
                    role_id: $('#role_id').val(),
                    note: $('#note').val(),
                    date: $('#date').val(),
                    image: $('#image').val(),

                },
                success: function(response) {
                    // Hide loading spinner
                    $('#loadingSpinner').css('display', 'none');

                    // Show success message
                    $('#successAlert').fadeIn().delay(3000).fadeOut();

                    console.log('response', response.message);

                    // Clear form fields
                    $('#title').val('');
                    $('#amount').val('');
                    $('#note').val('');
                    $('#image').val();

                },
                error: function(xhr, status, error) {
                    // Hide loading spinner
                    $('#loadingSpinner').css('display', 'none');
                    console.error('Error:', error);
                }
            });
        });

        // Add status badge display when changing type
        $('#type').on('change', function() {
            let statusValue = $(this).val();
            let statusClass = 'status-' + statusValue;

            // Update visual feedback based on selection
            $(this).removeClass('status-paid status-unpaid status-due')
                .addClass(statusClass);
        });
    });
</script>--}}
</body>
</html>
