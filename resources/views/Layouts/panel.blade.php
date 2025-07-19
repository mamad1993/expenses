<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد هزینه‌ها</title>

    <!-- DataTables and Dependencies -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <!-- Persian Font: Vazirmatn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css">

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
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        }

        .summary-cards .card.category-card {
            background: linear-gradient(135deg, #4e73df 0%, #3a5ccc 100%);
        }

        .summary-cards .card.stats-card {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
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

        .category-breakdown{
            background-color: white;
            border-radius: .5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .category-breakdown h5{
            text-align: center;
            color: #4e73df;
            font-weight: 700;
            margin-bottom: 1.5rem;

        }

        .category-breakdown .category-item{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .75rem 0;
            border-bottom: 1px solid #e3e6f0;
        }

        .category-breakdown .category-item:last-child{
            border-bottom: none;
        }

        .category-breakdown .category-item .category-name{
            font-weight: 700;
            color: #5a5c69;
        }

        .category-breakdown .category-item .category-amount{
            font-weight: 700;
            color: #4e73df;
            font-size: 1.1rem;
        }


        .category-breakdown .category-item .category-bar{
            height: 6px;
            background: linear-gradient(90deg, #4e73df, #36b9cc);
            border-radius: 3px;
            margin-top: .5rem;
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

        .category-badge{
            background-color: #4e73df;
            color: white;
            font-size: .75rem;
            padding: .25rem .65rem;
            border-radius: .35rem;
        }

        .badge{
            padding: .35rem .65rem;
            border-radius: .35rem;
            font-weight: 600;
        }

        .badge.badge-paid{
            background-color: #1cc88a;
            color: white;
        }

        .badge.badge-due{
            background-color: #e74a3b;
            color: white;
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
            color: #858796;
            font-size: 0.875rem;
        }


    </style>

</head>
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">تصویر هزینه</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
            </div>
            <div class="modal-body text-center">
                <img id="expenseImage" src="" alt="Expense Image" style="max-width: 100%; max-height: 60vh; object-fit: contain;">
            </div>
        </div>
    </div>
</div>
<body>
<div class="dashboard-header">
    <h1 class="dashboard-title">
        <i class="fas fa-chart-pie me-2"></i>
        داشبورد هزینه ها
    </h1>
    <p class="text-muted">مدیریت و بررسی هزینه های مالی</p>
</div>

<div>
    <a href="{{ url('expenses/create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus me-2"></i>
        هزینه جدید
    </a>
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
<div class="row summary-cards">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card total-card">
            <div class="card-body position-relative">
                <i class="fas fa-coins card-icon"></i>
                <div class="card-title">مجموع کل هزینه ها</div>
                <div class="amount-display animate-count">
                    {{ formatMoneyPersian($total) }}
                </div>
                <div class="amount-label">تومان</div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card category-card">
            <div class="card-body position-relative">
                <i class="fas fa-check-circle card-icon"></i>
                <div class="card-title">میانگین روزانه</div>
                <div class="amount-display animate-count">
                    {{ formatMoneyPersian($dailyAverage) }}
                </div>
                <div class="amount-label">تومان</div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body position-relative">
                <i class="fas fa-user card-icon"></i>
                <div class="card-title">طلبکار</div>
                <div class="amount-display animate-count">
                    {{ formatMoneyPersian($totalDues) }}
                </div>
                <div class="amount-label">تومان</div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card" style="background: linear-gradient(135deg, #36b9cc 0%, #258391 100%); color: white;">
            <div class="card-body position-relative">
                <i class="fas fa-list card-icon"></i>
                <div class="card-title">تعداد هزینه‌ها</div>
                <div class="amount-display animate-count">
                    {{ toPersianDigits($expenseCount) }}
                </div>
                <div class="amount-label">مورد</div>
            </div>
        </div>
    </div>
</div>

@if($totalByCategory->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="category-breakdown">
                <h5>
                    <i class="fas fa-chart-bar me-2"></i>
                    تفکیک هزینه ها براساس دسته بندی
                </h5>

                @foreach($totalByCategory as $categoryTotal)
                    @php
                        $category = $expenses->where('category_id', $categoryTotal->category_id)->first()->category ?? null;
                        $percentage = $maxCategoryTotal > 0 ? ($categoryTotal->total / $maxCategoryTotal) * 100 : 0;

                    @endphp
                    @if($category)
                        <div class="category-item">
                            <div>
                                <div class="category-name">
                                    <i class="fas fa-tag me-2" style="color: #4e73df"></i>
                                    {{ $category->name }}
                                </div>
                                <div class="category-bar" style="width: {{ $percentage }}px;"></div>
                            </div>
                            <div class="category-amount">
                                {{ formatMoneyPersian($categoryTotal->total) }} تومان
                            </div>
                        </div>

                    @endif
                @endforeach
            </div>
        </div>
    </div>

@endif


@if($totalByRoles->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="category-breakdown">
                <h5>
                    <i class="fas fa-users me-2"></i>
                    تفکیک هزینه‌ها بر اساس نقش‌ها
                </h5>

                @foreach($totalByRoles as $role)
                    @php
                    $rolefirst = $expenses->where('role_id', $role->role_id)->first()->role ?? null;
                    @endphp
                    @if($role->role_id !== 0)
                        <div class="category-item">
                            <div class="category-name">
                                {{ $rolefirst->role_name }} ( {{ $rolefirst->name }} )
                            </div>
                            <div class="category-amount">
                                {{ formatMoneyPersian($role->roleTotalAmount) }} تومان
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif



<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-table me-2"></i>جدول هزینه ها</h5>
        <div class="card-tools">
            <span class="badge bg-primary">به روز رسانی امروز</span>
        </div>
    </div>
    <div class="card-body">
        <table id="expenses-table" class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="text-right">شناسه</th>
                <th class="text-right">عنوان</th>
                <th class="text-right">دسته‌بندی</th>
                <th class="text-right">مبلغ (تومان)</th>
                <th class="text-right">وضعیت</th>
                <th class="text-right">تاریخ ثبت</th>
                <th>توضیحات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($expenses as $expense)
                <!-- <tr data-image="{{ $expense->image ? asset('storage/' . $expense->image) : '' }}"> -->
                <tr data-id="{{ $expense->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $expense->title }}</td>
                    <td>
                        <span class="category-badge">{{ $expense->category->name }}</span>
                    </td>
                    <td>
                        @if(strtolower($expense->type) === 'paid')
                            <span style="color: #1cc88a; font-weight: 700;">{{ formatMoneyPersian($expense->amount) }}</span>
                        @else
                            <span style="color: #e74a3b; font-weight: 700">{{ formatMoneyPersian($expense->amount) }}</span>
                        @endif
                    </td>
                    <td>
                        @if(strtolower($expense->type === 'paid'))
                            <span class="badge badge-paid">
                                <i class="fas fa-check me-1"></i>پرداخت شده
                            </span>
                        @else
                            <span class="badge badge-due">
                                <i class="fas fa-user me-1"></i>طلبکار
                            </span>
                        @endif
                    </td>
                    <td>{{ toPersianDigits(\Morilog\Jalali\Jalalian::fromDateTime($expense->created_at)->format('Y/m/d')) }}</td>
                    <td>{{ $expense->note ?: '-' }}</td>

                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>

<div class="footer">
    <p>© {{ toPersianDigits('2025') }} سیستم مدیریت مالی | نسخه {{ toPersianDigits('2.5') }}</p>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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

<script>
    $(document).ready(function (){

        function normalizeEnglishDigits(str){
            if (!str) return '';
            const persianNumbers = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
            const englishNumbers = ['0','1','2','3','4','5','6','7','8','9'];

            let result = str.toString();
            for (let i = 0; i < 10; i++){
                const regex = new RegExp(persianNumbers[i], 'g');
                result = result.replace(regex, englishNumbers[i]);
            }
            result = result.replace(/,|s/g, '');
            return result;
        }

        // Initialize DataTable
        const table = $('#expenses-table').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-3"<"d-flex align-items-center"B><"d-flex align-items-center"f>>rtip',
            buttons: ['copy', 'excel', 'print'],
            responsive: true,
            ordering: true,
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
                    targets: [3, 5],
                    render: function (data, type, row){
                        if(type === 'display'){
                            return data;
                        }
                        else if(type === 'filter' || type === 'sort'){
                            return normalizeEnglishDigits(data);
                        }
                        return data;
                    }
                },
            ],
        });

        // Initialize Bootstrap Modal
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'), {
            keyboard: true,
            backdrop: true,
            focus: true
        });

        // Handle table row clicks for image modal
        /* $('#expenses-table tbody').on('click', 'tr', function (){
            const imageUrl = $(this).data('image');

            if(imageUrl && imageUrl !== ''){
                $('#expenseImage').attr('src', imageUrl);
                imageModal.show();
            }
        }); */
        $('#expenses-table tbody').on('click', 'tr', function(){
            const expenseId = $(this).data('id');
            

            if(expenseId){
                $.ajax({
                    url: `/expenses/image/${expenseId}`,
                    type: 'GET',
                    success: function(response){

                        if(response.image_url){
                            $('#expenseImage').attr('src', response.image_url);
                            imageModal.show();

                        }
                    },
                    error: function () {
                    alert('Error fetching image.');
                }
                });
            }
        });
    });
</script>

</body>

</html>

