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

        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-title {
            color: #4e73df;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 2rem;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h5 {
            color: #4e73df;
            font-weight: 700;
            margin: 0;
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Summary Cards */
        .summary-cards .card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            margin-bottom: 1.5rem;
        }

        .summary-cards .card.total-card {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        }

        .summary-cards .card.category-card {
            background: linear-gradient(135deg, #4e73df 0%, #3a5ccc 100%);
        }

        .summary-cards .card.stats-card {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        }

        .summary-cards .card-body {
            text-align: center;
            padding: 2rem 1.25rem;
        }

        .summary-cards .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .summary-cards .amount-display {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .summary-cards .amount-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .summary-cards .card-icon {
            font-size: 3rem;
            opacity: 0.2;
            position: absolute;
            top: 1rem;
            left: 1rem;
        }

        /* Category breakdown */
        .category-breakdown {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .category-breakdown h5 {
            color: #4e73df;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e3e6f0;
        }

        .category-item:last-child {
            border-bottom: none;
        }

        .category-name {
            font-weight: 600;
            color: #5a5c69;
        }

        .category-amount {
            font-weight: 700;
            color: #4e73df;
            font-size: 1.1rem;
        }

        .category-bar {
            height: 6px;
            background: linear-gradient(90deg, #4e73df, #36b9cc);
            border-radius: 3px;
            margin-top: 0.5rem;
        }

        /* DataTables Styling */
        table.dataTable {
            border-collapse: collapse !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        table.dataTable thead th {
            border-bottom: 1px solid #e3e6f0;
            font-weight: 700;
            color: #4e73df;
            padding: 0.75rem;
            vertical-align: middle;
            text-align: right !important;
        }

        table.dataTable tbody td {
            padding: 0.75rem;
            vertical-align: middle;
            border-bottom: 1px solid #e3e6f0;
        }

        table.dataTable tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 1rem;
            color: #858796;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 0.35rem;
            margin: 0 0.25rem;
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
        }

        .dt-buttons .btn {
            border-radius: 0.35rem;
            padding: 0.375rem 0.75rem;
            margin-left: 0.5rem;
            font-size: 0.875rem;
        }

        .badge {
            padding: 0.35em 0.65em;
            border-radius: 0.35rem;
            font-weight: 600;
        }

        .badge-expense {
            background-color: #e74a3b;
            color: white;
        }

        .badge-income {
            background-color: #1cc88a;
            color: white;
        }

        .badge-paid {
            background-color: #1cc88a;
            color: white;
        }

        .badge-due {
            background-color: #e74a3b;
            color: white;
        }

        .amount-cell {
            font-weight: 600;
            text-align: left;
        }

        .amount-expense {
            color: #e74a3b;
        }

        .amount-income {
            color: #1cc88a;
        }

        .category-badge {
            background-color: #4e73df;
            color: white;
            font-size: 0.75rem;
            padding: 0.25em 0.65em;
            border-radius: 0.35rem;
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
            color: #858796;
            font-size: 0.875rem;
        }

        /* Custom Button Styling */
        .dt-button {
            background: linear-gradient(180deg, #4e73df 0%, #3a5ccc 100%) !important;
            color: white !important;
            border: none !important;
            border-radius: 0.35rem !important;
            box-shadow: 0 0.125rem 0.25rem 0 rgba(58, 59, 69, 0.2) !important;
            transition: all 0.15s ease-in-out !important;
            padding: 0.375rem 0.75rem !important;
            font-size: 0.875rem !important;
            font-family: 'Vazirmatn', 'Tahoma', sans-serif !important;
        }

        .dt-button:hover {
            background: linear-gradient(180deg, #3a5ccc 0%, #2a4399 100%) !important;
            box-shadow: 0 0.25rem 0.5rem 0 rgba(58, 59, 69, 0.3) !important;
        }

        .dt-button.buttons-copy::before {
            content: "📋 ";
        }

        .dt-button.buttons-csv::before {
            content: "📄 ";
        }

        .dt-button.buttons-excel::before {
            content: "📊 ";
        }

        .dt-button.buttons-pdf::before {
            content: "📑 ";
        }

        .dt-button.buttons-print::before {
            content: "🖨️ ";
        }

        /* RTL-specific adjustments */
        .dataTables_filter {
            text-align: left !important;
        }

        .dataTables_filter input {
            margin-right: 0.5em !important;
            margin-left: 0 !important;
        }

        .dt-buttons {
            margin-right: 0 !important;
        }

        /* Fix Persian number alignment in table */
        .text-end-persian {
            text-align: left !important;
        }

        /* Fix header alignment for RTL */
        .dataTable th {
            text-align: right !important;
        }

        /* Fix sorting icons alignment */
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:after {
            right: auto;
            left: 8px;
        }

        /* Animated counters */
        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-count {
            animation: countUp 0.8s ease-out;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .summary-cards .amount-display {
                font-size: 2rem;
            }

            .category-breakdown {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
@php
    function toPersianDigits($number) {
        $persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $english = ['0','1','2','3','4','5','6','7','8','9'];
        return str_replace($english, $persian, $number);
    }

    function formatMoneyPersian($amount) {
        return toPersianDigits(number_format($amount));
    }

    // Calculate additional statistics
    $paidExpenses = $expenses->where('type', 'paid');
    $dueExpenses = $expenses->where('type', '!=', 'paid');
    $totalPaid = $paidExpenses->sum('amount');
    $totalDue = $dueExpenses->sum('amount');
    $expenseCount = $expenses->count();

    // Get max category total for progress bars
    $maxCategoryTotal = $totalByCategory->max('total');
@endphp

<div class="dashboard-header">
    <h1 class="dashboard-title">
        <i class="fas fa-chart-pie me-2"></i>
        داشبورد هزینه‌ها
    </h1>
    <p class="text-muted">مدیریت و بررسی هزینه‌های مالی</p>
</div>

<div>
    <a href="{{ url('expenses/create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus me-2"></i>
        هزینه جدید
    </a>
</div>

<!-- Summary Cards Row -->
<div class="row summary-cards">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card total-card">
            <div class="card-body position-relative">
                <i class="fas fa-coins card-icon"></i>
                <div class="card-title">مجموع کل هزینه‌ها</div>
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
                <div class="card-title">پرداخت شده</div>
                <div class="amount-display animate-count">
                    {{ formatMoneyPersian($totalPaid) }}
                </div>
                <div class="amount-label">تومان</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body position-relative">
                <i class="fas fa-clock card-icon"></i>
                <div class="card-title">طلبکار</div>
                <div class="amount-display animate-count">
                    {{ formatMoneyPersian($totalDue) }}
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

<!-- Category Breakdown -->
@if($totalByCategory->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="category-breakdown">
                <h5>
                    <i class="fas fa-chart-bar me-2"></i>
                    تفکیک هزینه‌ها بر اساس دسته‌بندی
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
                                    <i class="fas fa-tag me-2" style="color: #4e73df;"></i>
                                    {{ $category->name }}
                                </div>
                                <div class="category-bar" style="width: {{ $percentage }}%;"></div>
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

<!-- Expenses Table -->
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-table me-2"></i>جدول هزینه‌ها</h5>
        <div class="card-tools">
            <span class="badge bg-primary">به‌روزرسانی: امروز</span>
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
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $expense->title }}</td>
                    <td>
                        <span class="category-badge">{{ $expense->category->name }}</span>
                    </td>
                    <td style="text-align: right !important;">
                        @if(strtolower($expense->type) === 'paid')
                            <span style="color: #1cc88a; font-weight: 700;">{{ formatMoneyPersian($expense->amount) }}</span>
                        @else
                            <span style="color: #e74a3b; font-weight: 700;">{{ formatMoneyPersian($expense->amount) }}</span>
                        @endif
                    </td>
                    <td>
                        @if(strtolower($expense->type) === 'paid')
                            <span class="badge badge-paid">
                                <i class="fas fa-check me-1"></i>پرداخت شده
                            </span>
                        @else
                            <span class="badge badge-due">
                                <i class="fas fa-clock me-1"></i>طلبکار
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

<!-- Scripts -->
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

<script>
    $(document).ready(function() {
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
                    targets: [3, 5, 6],
                    render: function(data, type, row) {
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
            search: {
                caseInsensitive: true,
                smart: false
            }
        });

        // Add some animation delay to cards
        $('.summary-cards .card').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
        });
    });
</script>

</body>
</html>
