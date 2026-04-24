<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد کارگران</title>

    <!-- DataTables and Dependencies -->
  {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker/dist/css/persian-datepicker.min.css">

    <!-- Persian Font: Vazirmatn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css">
--}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --dark-color: #5a5c69;
            --light-color: #f8f9fc;
        }

        body {
            font-family: 'Vazirmatn', 'Tahoma', sans-serif;
            background-color: #f8f9fc;
            color: #5a5c69;
            padding: 1.5rem;
            text-align: right;
        }

        .dashboard-header{
            margin-bottom: 2rem;
        }

        .dashboard-title{
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .summary-cards .card{
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 2rem;
            transition: transform .2s ease-in-out;
        }

        .summary-cards .card:hover{
            transform: translateY(-2px);
        }

        .summary-cards .card {
            color: white;
            border: none;
            margin-bottom: 1.5rem;
        }

        .summary-cards .card.total-card{
            background: linear-gradient(135deg, #e74a3b 0%, #c93a2b 100%);
        }

        .summary-cards .card.total-payment-card{
            background: linear-gradient(135deg, #4e73df 0%, #1a3cb8 100%);
        }

        .summary-cards .card.simple-card {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        }

        .summary-cards .card.expert-card {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        }

        .summary-cards .card.total-worker-card{
            background: linear-gradient(135deg, #fd7e14 0%, #dc3545 100%);
        }

        .summary-cards .card .card-body{
            text-align: center;
            padding: 2rem 1.25rem;
        }

        .summary-cards .card .card-title{
            font-size: 1.1rem;
            font-weight: 600;
        }

        .summary-cards .card .amount-display{
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: .5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .summary-cards .card .card-icon{
            position: absolute;
            left: 1rem;
            top: 1rem;
            font-size: 3rem;
            opacity: .2;
        }

        .form-section {
            background-color: white;
            border-radius: .5rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .form-section h5 {
            color: #4e73df;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            color: #5a5c69;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.75rem;
            font-family: 'Vazirmatn', 'Tahoma', sans-serif;
        }

        .form-control:focus, .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e73df 0%, #3a5ccc 100%);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.35rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(78, 115, 223, 0.3);
        }

        .card-header{
            background-color: #f8f9fc;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #e3e6f0;
            align-items: center;
            padding: 1rem 1.25rem;
        }

        .card-header h5{
            color: #4e73df;
            font-weight: 700;
            margin: 0;
        }

        table.dataTable{
            border-collapse: collapse !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        table.dataTable thead th{
            border-bottom: 1px solid #e3e6f0;
            font-weight: bold;
            color: #4e73df;
            padding: .75rem;
            text-align: right !important;
        }

        table.dataTable tbody td{
            padding: .75rem;
        }

        .table.dataTable tbody tr:hover td {
            background-color: rgba(78, 115, 223, 0.05) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 0.35rem;
            margin: 0 0.25rem;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 1rem;
            color: #858796;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4e73df !important;
            border-color: #4e73df !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.375rem 0.75rem;
            margin-right: .5rem;
        }

        .dt-buttons .btn {
            border-radius: 0.35rem;
            padding: 0.375rem 0.75rem;
            margin-left: 0.5rem;
            font-size: 0.875rem;
        }

        .badge{
            padding: .35rem .65rem;
            border-radius: .35rem;
            font-weight: 600;
        }

        .badge.badge-simple{
            background-color: #f6c23e;
            color: white;
        }

        .badge.badge-expert{
            background-color: #1cc88a;
            color: white;
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
            color: #858796;
            font-size: 0.875rem;
        }

        .alert {
            border-radius: 0.35rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .dt-buttons button {
            margin-right: 5px;
        }

        .dt-buttons .btn{
            border-radius: 0;
        }


    </style>
</head>
<body>

<div class="dashboard-header">
    <h1 class="dashboard-title">
        <i class="fas fa-users me-2"></i>
        داشبورد کارگران
    </h1>
    <p class="text-muted">مدیریت کارگران و پرداخت‌ها</p>
</div>

@php
    function toPersianDigits($number){
        $persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $english = ['0','1','2','3','4','5','6','7','8','9'];
        return str_replace($english, $persian, $number);
    }

    function formatMoneyPersian($amount){
        return toPersianDigits(number_format($amount));
    }


@endphp

    <!-- Success/Error Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
    </div>
@endif

<!-- Section 1: Summary Cards -->
<div class="row summary-cards">
    <div class="col-xl-3 col-md-6">
        <div class="card total-card">
            <div class="card-body position-relative">
                <i class="fas fa-wallet card-icon"></i>
                <div class="card-title">کل بدهی به کارگران</div>
                <div class="amount-display">
                    {{ formatMoneyPersian($dueConstructorsPayment) }}
                </div>
                <div class="amount-label">تومان</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card total-worker-card">
            <div class="card-body position-relative">
                <i class="fas fa-wallet card-icon"></i>
                <div class="card-title">کارکرد کل کارگران</div>
                <div class="amount-display">
                    {{ formatMoneyPersian($totalWorkersEarned) }}
                </div>
                <div class="amount-label">تومان</div>
            </div>
        </div>
    </div>



    <div class="col-xl-3 col-md-6">
        <div class="card simple-card">
            <div class="card-body position-relative">
                <i class="fas fa-user card-icon"></i>
                <div class="card-title">کارکرد کارگران ساده</div>
                <div class="amount-display">
                    {{ formatMoneyPersian($simpleWorkers) }}
                </div>
                <div class="amount-label">تومان</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card expert-card">
            <div class="card-body position-relative">
                <i class="fas fa-user-tie card-icon"></i>
                <div class="card-title">کارکرد کارگران استاد بنا</div>
                <div class="amount-display">
                    {{ formatMoneyPersian($expertWorkers) }}
                </div>
                <div class="amount-label">تومان</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card total-payment-card">
            <div class="card-body position-relative">
                <i class="fas fa-wallet card-icon"></i>
                <div class="card-title">کل پرداختی به کارگران</div>
                <div class="amount-display">
                    {{ formatMoneyPersian($allPayment) }}
                </div>
                <div class="amount-label">تومان</div>
            </div>
        </div>
    </div>

</div>


<!-- Section 2: Payment Form -->


<!-- Section 3: Constructor Registration Form -->
<div class="row">
    <div class="col-12">
        <div class="form-section">
            <h5>
                <i class="fas fa-user-plus me-2"></i>
                ثبت کارگر جدید
            </h5>
            <form action="{{ route('constructors.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="constructor_name" class="form-label">نام کارگر</label>
                        <input type="text" class="form-control" id="constructor_name" name="name" placeholder="نام و نام خانوادگی" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="constructor_date" class="form-label">تاریخ</label>
                        <input
                            type="text"
                            class="form-control persian-date"
                            name="date"
                            autocomplete="off"
                            placeholder="انتخاب تاریخ"
                        >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="constructor_amount" class="form-label">مبلغ (تومان)</label>
                        <input type="number" class="form-control" id="constructor_amount" name="amount"  value="2300000" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="constructor_type" class="form-label">نوع کارگر</label>
                        <select class="custom-select" id="constructor_type" name="type" required>
                            <option value="">انتخاب کنید</option>
                            <option value="simple">ساده</option>
                            <option value="expert" selected>استاد بنا</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-check me-2"></i>
                        ثبت کارگر
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-section">
            <h5>
                <i class="fas fa-money-bill-wave me-2"></i>
                ثبت پرداخت به کارگران
            </h5>
            <form action="{{ route('workers.payment.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="payment_date" class="form-label">تاریخ پرداخت</label>
                        <input
                            type="text"
                            class="form-control persian-date"
                            name="date"
                            autocomplete="off"
                            placeholder="انتخاب تاریخ"
                        >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="payment_amount" class="form-label">مبلغ (تومان)</label>
                        <input type="number" class="form-control" id="payment_amount" name="amount" placeholder="۱۰۰۰۰۰۰" value="{{ old('amount') }}" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check me-2"></i>
                        ثبت پرداخت
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Section 4: Constructors DataTable -->
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-table me-2"></i>لیست کارگران</h5>

    </div>
    <div class="card-body">
        <table id="constructors-table" class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="text-right">ردیف</th>
                <th class="text-right">نام کارگر</th>
                <th class="text-right">تاریخ</th>
                <th class="text-right">مبلغ (تومان)</th>
                <th class="text-right">نوع</th>

            </tr>
            </thead>
            <tbody>
            @foreach($constructors as $constructor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $constructor->name }}</td>
                    <td>{{ toPersianDigits($constructor->date) }}</td>
                    <td style="color: #e74a3b; font-weight: 700;">{{ formatMoneyPersian($constructor->amount) }}</td>
                    <td>
                        @if($constructor->type === 'simple')
                            <span class="badge badge-simple">
                                <i class="fas fa-user me-1"></i>ساده
                            </span>
                        @else
                            <span class="badge badge-expert">
                                <i class="fas fa-user-tie me-1"></i>استاد بنا
                            </span>
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="footer">
    <p>© {{ toPersianDigits('2025') }} سیستم مدیریت کارگران | نسخه {{ toPersianDigits('1.0') }}</p>
</div>

{{--<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/persian-date/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker/dist/js/persian-datepicker.min.js"></script>--}}

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(document).ready(function (){

        //hereeeeeeeeeeeeee
        /*const todayJ = new persianDate(); // از زمان محلی استفاده می‌کند
        const todayFormatted = todayJ.format('YYYY/MM/DD');

        // ۲) مقداردهی دستی به همه‌ی ورودی‌های .persian-date
        $('.persian-date').each(function(){
            $(this).val(todayFormatted); // مقدار مستقیم می‌نویسد (اعداد انگلیسی)
        });

        // ۳) سپس datepicker را بدون initialValue فعال کن (تا مقدار فعلی input را نگه دارد)
        $('.persian-date').persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValue: false,
            autoClose: true,

        });
        function normalizeEnglishDigits(str){
            if (!str) return '';
            const persianNumbers = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
            const englishNumbers = ['0','1','2','3','4','5','6','7','8','9'];

            let result = str.toString();
            for (let i = 0; i < 10; i++){
                const regex = new RegExp(persianNumbers[i], 'g');
                result = result.replace(regex, englishNumbers[i]);
            }
            result = result.replace(/,/g, '');
            return result;
        }*/

        // Initialize DataTable
        $('#constructors-table').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-3"<"d-flex align-items-center"B><"d-flex align-items-center"f>>rtip',
            buttons: ['copy', 'excel', 'print'],
            responsive: true,
            ordering: true,
            order: [0, 'desc'],
            language: {
                search: "جستجو:",
                lengthMenu: "نمایش _MENU_ رکورد در هر صفحه",
                info: "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                infoEmpty: "هیچ رکوردی یافت نشد",
                infoFiltered: "(فیلتر شده از _MAX_ رکورد)",
                zeroRecords: "هیچ رکوردی یافت نشد",
                emptyTable: "هیچ داده‌ای در جدول وجود ندارد",
                paginate: {
                    first: "اولین",
                    previous: "قبلی",
                    next: "بعدی",
                    last: "آخرین"
                },
            },
            columnDefs: [
                {
                    targets: [2, 3],
                    render: function (data, type, row){
                        if(type === 'display'){
                            return data;
                        }
                        else if(type === 'filter' || type === 'sort'){
                            ///hereeeeeeeeeee
                            /*return normalizeEnglishDigits(data);*/
                        }
                        return data;
                    }
                },
            ],
        });
    });
</script>

</body>
</html>
