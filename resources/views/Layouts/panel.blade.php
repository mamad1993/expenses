<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد هزینه‌ها</title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<!-- Modal correctly placed inside body -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="direction: rtl">
                <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title font-weight-bold text-dark" id="imageModalLabel">تصویر هزینه</h5>

            </div>
            <div class="modal-body text-center p-4">
                <img id="expenseImage" src="" alt="Expense Image" style="max-width: 100%; max-height: 60vh; border-radius: 8px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<div class="main-wrapper">
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">
                <i class="fas fa-chart-pie me-2" style="color: var(--primary);"></i>
                داشبورد هزینه‌ها
            </h1>
            <p class="dashboard-subtitle">مدیریت و بررسی دقیق هزینه‌های مالی سیستم</p>
        </div>
        <div>
            <a href="{{ url('expenses/create') }}" class="btn-custom-primary">
                <i class="fas fa-plus me-2"></i>
                ثبت هزینه جدید
            </a>
        </div>
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
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card total-card">
                <div class="card-body">
                    <i class="fas fa-wallet card-icon"></i>
                    <div class="card-title">مجموع کل هزینه‌ها</div>
                    <div class="amount-display">
                        {{ formatMoneyPersian($total) }}
                    </div>
                    <div class="amount-label">تومان</div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card category-card">
                <div class="card-body">
                    <i class="fas fa-calendar-day card-icon"></i>
                    <div class="card-title">میانگین روزانه</div>
                    <div class="amount-display">
                        {{ formatMoneyPersian($dailyAverage) }}
                    </div>
                    <div class="amount-label">تومان</div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card count-card">
                <div class="card-body">
                    <i class="fas fa-receipt card-icon"></i>
                    <div class="card-title">تعداد تراکنش‌ها</div>
                    <div class="amount-display">
                        {{ toPersianDigits($expenseCount) }}
                    </div>
                    <div class="amount-label">مورد ثبت شده</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if($totalByCategory->count() > 0)
            <div class="col-lg-6 mb-4">
                <div class="content-card h-100">
                    <div class="content-card-header">
                        <i class="fas fa-chart-bar"></i>
                        تفکیک هزینه‌ها براساس دسته‌بندی
                    </div>

                    @foreach($totalByCategory as $categoryTotal)
                        @php
                            $category = $expenses->where('category_id', $categoryTotal->category_id)->first()->category ?? null;
                            $percentage = $maxCategoryTotal > 0 ? ($categoryTotal->total / $maxCategoryTotal) * 100 : 0;
                        @endphp
                        @if($category)
                            <div class="category-wrapper">
                                <div class="category-item" data-id="{{ $categoryTotal->category_id }}" style="cursor: pointer">
                                    <div class="category-info">
                                        <div class="category-name">
                                            {{ $category->name }}
                                        </div>
                                        <div class="category-amount">
                                            {{ formatMoneyPersian($categoryTotal->total) }} تومان
                                        </div>
                                    </div>
                                    <div class="category-track">
                                        <div class="category-bar" style="width: {{ $percentage }}%;"></div>
                                    </div>
                                </div>
                                <div class="sub-category-container"
                                     id="sub-category-{{ $categoryTotal->category_id }}"
                                     style=" display: none; padding: 10px 15px 0 0">

                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <div class="col-lg-6 mb-4">
            <div class="content-card h-100">
                <div class="content-card-header">
                    <i class="fas fa-users"></i>
                    <span>جزئیات بخش‌ها</span>
                </div>

                <div class="card-body p-3">
                    <div id="detail-placeholder" style="text-align: center; color: #888; padding: 20px">
                        لطفاً برای مشاهده جزئیات، روی یکی از دسته‌بندی‌ها کلیک کنید.
                    </div>

                    <div id="details-loading" style="display: none; text-align: center; padding: 20px">
                        در حال بارگذاری اطلاعات...
                    </div>

                    <div class="table-responsive" style="border: none">
                        <table class="table" id="detail-table" style="display: none; margin: 0">
                            <thead>
                            <tr>
                                <th>بخش</th>
                                <th>مبلغ کل</th>

                            </tr>
                            </thead>
                            <tbody id="details-tbody">

                            </tbody>
                        </table>
                    </div>
                    <div id="omran-fields-container"></div>

                </div>
            </div>
        </div>

    </div>

    <div class="content-card">
        <div class="content-card-header">
            <i class="fas fa-table"></i>
            لیست جامع هزینه‌ها
        </div>
        <div class="table-responsive">
            <table id="expenses-table" class="table">
                <thead>
                <tr>
                    <th>شناسه</th>
                    <th>عنوان هزینه</th>
                    <th>دسته‌بندی</th>
                    <th>مبلغ (تومان)</th>
                    <th>تاریخ ثبت</th>
                    <th>توضیحات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($expenses as $expense)
                    <tr data-id="{{ $expense->id }}">
                        <td class="font-weight-bold text-muted">{{ $loop->iteration }}</td>
                        <td class="font-weight-bold">{{ $expense->title }}</td>
                        <td>
                            <span class="category-badge">{{ $expense->category->name }}</span>
                        </td>
                        <td>
                            <span class="amount-highlight">{{ formatMoneyPersian($expense->amount) }}</span>
                        </td>
                        <td>{{ toPersianDigits(\Morilog\Jalali\Jalalian::fromDateTime($expense->created_at)->format('Y/m/d')) }}</td>
                        <td class="text-muted">{{ $expense->note ?: '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        <p>© {{ toPersianDigits('2025') }} سیستم مدیریت مالی | نسخه {{ toPersianDigits('2.5') }}</p>
    </div>
</div>

<!-- Scripts -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

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

        function toPersianDigitsJS(amount){
            if(amount === null || amount === undefined) return '';

            const withCommas = Number(amount).toLocaleString('en-US');
            const persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
            return withCommas.replace(/[0-9]/g, d=>persian[d]);

        }


        $('.category-item').on('click', function(){
            let categoryId = $(this).data('id');

            let subContainer = $(`#sub-category-${categoryId}`);

            $('#detail-table').hide();
            $('#detail-placeholder').hide();
            $('#details-tbody').empty();
            switch (categoryId) {
                case 1:
                    $('#detail-placeholder').hide();
                    $('#details-loading').show();

                    $('.sub-category-container').slideUp(300).empty();

                    $('#omran-fields-container').empty();
                    $('#details-tbody').empty();
                    $('#detail-table').hide();


                    $.ajax({
                        url: `/expenses/fetchDetails/${categoryId}`,
                        type: 'GET',
                        success: function(response) {
                            $('#details-loading').hide();
                            if (response.munSecDetails && response.munSecDetails.length > 0) {
                                $.each(response.munSecDetails, function(index, item) {
                                    let row = `
                              <tr>
                                <td>${item.section_name}</td>
                                <td>${toPersianDigitsJS(item.details_sum_amount)}</td>
                              </tr>
                            `;
                                    $('#details-tbody').append(row);
                                });
                                $('#detail-table').fadeIn(300);
                            } else {
                                $('#detail-placeholder').text('هیچ داده ای برای این بخش یافت نشد').show();
                            }
                        },
                    });
                    break;


                case 6:
                    if(subContainer.children().length > 0){
                        subContainer.slideToggle(300);
                        $('#omran-fields-container').empty();
                        $('#detail-placeholder').text('لطفاً برای مشاهده جزئیات، روی یکی از دسته ها کلیک کنید.').show();


                    }else{
                        $('#detail-placeholder').text('در حال بارگذاری زیربخش‌ها...').show();
                        $.ajax({
                            url: `/expenses/OmranSectionTotals/${categoryId}`,
                            type: 'GET',
                            success: function (response){
                                if(response.omranSectionTotals && response.omranSectionTotals.length > 0){
                                    let subItemsHtml = '';
                                    $.each(response.omranSectionTotals, function (index, item){
                                        subItemsHtml += `
                                        <div class="sub-category-item" data-section-id="${item.id}"
                                        style="padding: 12px; margin-bottom: 8px; background-color: #f8f9fa;
                                        border-radius: 6px; border-right: 4px solid purple;
                                        cursor: pointer; transition: background .2s;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="font-weight-bold text-dark">${item.name}</span>
                                                <span class="text-muted" style="font-size: .9rem">${toPersianDigitsJS(item.total_amount || 0)}</span>

                                            </div>
                                        </div>

                                    `;
                                    });

                                    subContainer.html(subItemsHtml).slideToggle(300);
                                    $('#detail-placeholder').text('لطفاً روی یکی از زیربخش‌ها (مهندسان، مجریان و...) کلیک کنید.').show();

                                }else{
                                    $('#detail-placeholder').text('زیربخشی برای این دسته یافت نشد').show();
                                }
                            },
                        });
                    }
                break;

                default:
                    // برای سایر دسته‌بندی‌ها
                    $('.sub-category-container').slideUp(300);
                    $('#detail-placeholder').text('هیچ داده ای برای این بخش یافت نشد').show();
                    break;
            }

        });


        $(document).on('click', '.sub-category-item', function (){
            let sectionId = $(this).data('section-id');
            let fieldName = $(this).find('.text-dark').text().trim();
            $('#detail-placeholder').hide();
            $('#details-loading').show();
            $('#detail-table').hide();

            $.ajax({
                url: '/expenses/OmranFieldTotals/' + sectionId,
                type: 'GET',
                success: function (response){
                    $('#details-loading').hide();
                    $("#omran-fields-container").empty();

                    let item = response.omranFieldTotals;
                    item.forEach(item => {

                        if(item.distinctEmployeeCount === 1){
                            rowHtml = `
                                <div class="omran-row">
                                    <span>${item.name}<span>(${item.singleEmployeeName})</span></span>

                                    <span>${toPersianDigitsJS(item.totalFieldExpenses)}</span>

                                </div>
                            `;

                            $("#omran-fields-container").append(rowHtml);
                        }else if(item.distinctEmployeeCount === 0){
                            return;
                        }else{
                            rowHtml = `
                    <div class="omran-row clickable" data-field-id="${item.id}">
                        <span class="blue-text">${item.name}</span>
                        <span class="blue-text">${toPersianDigitsJS(item.totalFieldExpenses)}</span>
                    </div>



                    <div class="employees-subrow" id="subrow-${item.id}" style="display: none">
                        <div class="d-flex flex-column" id="mul_employee_expenses-${item.id}">

                        </div>
                    </div>

                `;
                            $('#omran-fields-container').append(rowHtml);
                        }
                    });

                },
            });

        });

        $(document).on('click', '.omran-row', function (){
            let fieldId = $(this).data('field-id');
            let subrow = $('#subrow-' + fieldId);

            let mulEmployeeExpenses = $('#mul_employee_expenses-' + fieldId);

            if(subrow.is(':visible')){
                subrow.slideUp();
                return;

            }

            mulEmployeeExpenses.empty();


            $.ajax({
                url: '/expenses/employeeExpensesDetail/' + fieldId,
                type: 'GET',
                success: function (response){
                    response.TotalEmployeeExpenses.forEach(item => {
                        rowHtml = `
                            <div class="d-flex justify-content-between employee-detail">
                                <span>${item.employee_name}</span>
                                <span>${toPersianDigitsJS(item.total_amount)}</span>
                            </div>
                        `;
                        mulEmployeeExpenses.append(rowHtml);
                    });
                    subrow.slideDown();
                }

            });


        });



        // Initialize DataTable
        const table = $('#expenses-table').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-4"<"d-flex align-items-center"B><"d-flex align-items-center"f>>rtip',
            buttons: [
                { extend: 'copy', text: 'کپی', className: 'btn' },
                { extend: 'excel', text: 'اکسل', className: 'btn' },
                { extend: 'print', text: 'چاپ', className: 'btn' }
            ],
            responsive: true,
            ordering: true,
            order: [0, 'desc'],
            language: {
                search: "جستجو در جدول:",
                lengthMenu: "نمایش _MENU_ رکورد",
                info: "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                infoEmpty: "رکوردی یافت نشد",
                infoFiltered: "(فیلتر شده از _MAX_ رکورد)",
                zeroRecords: "موردی با این مشخصات یافت نشد",
                emptyTable: "داده‌ای برای نمایش وجود ندارد",
                paginate: {
                    first: "ابتدا",
                    previous: "قبلی",
                    next: "بعدی",
                    last: "انتها"
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
                        // Silent fail or console log visually cleaner without alert box interruptions
                        console.error('Error fetching image.');
                    }
                });
            }
        });
    });
</script>

</body>
</html>
