<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Dashboard</title>

    <!-- DataTables and Dependencies -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fc;
            color: #5a5c69;
            padding: 1.5rem;
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
            margin-right: 0.5rem;
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

        /* New badge classes for Paid and Due */
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
            text-align: right;
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
    </style>
</head>
<body>
last but not least changes on mac
<div class="dashboard-header">
    <h1 class="dashboard-title">Expenses Dashboard</h1>
    <p class="text-muted">Track, manage, and analyze your financial transactions</p>
</div>


hello from outsider
<div class="card">
    how are u
    <div class="card-header">
        card header changes
        <h5><i class="fas fa-table me-2"></i>Expenses Table</h5>
        table changes
        <div class="card-tools">
            <span class="badge bg-primary">Updated: Today</span>
        </div>
    </div>
    <div class="card-body">
        other changes on mac
        <table id="expenses-table" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Hours</th>
                <th>Note</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->id }}</td>
                    <td>{{ $expense->title }}</td>
                    <td>
                        @if($expense->category && $expense->category->name)
                            <span class="category-badge">{{ $expense->category->name }}</span>
                        @else
                            —
                        @endif
                    </td>
                    <td class="amount-cell {{ strtolower($expense->type) == 'expense' ? 'amount-expense' : 'amount-income' }}">
                        {{ number_format($expense->amount) }}
                    </td>
                    <td>{{ $expense->type }}</td>
                    <td>{{ $expense->number_of_hours ?? '—' }}</td>
                    <td>{{ $expense->note ?? '—' }}</td>
                    <td>{{ $expense->created_at }}</td>
                    <td>{{ $expense->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="footer">
    <p>© 2025 Financial Management System | Dashboard v2.5</p>
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
        // Initialize DataTable with all features
        $('#expenses-table').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-3"<"d-flex align-items-center"B><"d-flex align-items-center"f>>rtip',
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-sm'
                },
                {
                    extend: 'csv',
                    className: 'btn-sm'
                },
                {
                    extend: 'excel',
                    className: 'btn-sm'
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm'
                },
                {
                    extend: 'print',
                    className: 'btn-sm'
                }
            ],
            responsive: true,
            ordering: true,
            language: {
                search: "جستجو:",
                lengthMenu: "نمایش _MENU_ رکورد",
                info: "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                paginate: {
                    previous: "قبلی",
                    next: "بعدی"
                }
            },
            columnDefs: [
                {
                    // Modified Type column to handle Paid/Due status
                    targets: 4,
                    render: function(data, type, row) {
                        if (type === 'display') {
                            if (data.toLowerCase().includes('paid')) {
                                return '<span class="badge badge-paid">Paid</span>';
                            } else if (data.toLowerCase().includes('due')) {
                                return '<span class="badge badge-due">Due</span>';
                            } else if (data.toLowerCase().includes('expense')) {
                                return '<span class="badge badge-expense">Expense</span>';
                            } else if (data.toLowerCase().includes('income')) {
                                return '<span class="badge badge-income">Income</span>';
                            }
                            return data;
                        }
                        return data;
                    }
                },
                {
                    // Style the Amount column
                    targets: 3,
                    render: function(data, type, row) {
                        if (type === 'display') {
                            const isExpense = row[4].toLowerCase().includes('expense');
                            const className = isExpense ? 'amount-expense' : 'amount-income';
                            return '<div class="amount-cell ' + className + '">' + data + '</div>';
                        }
                        return data;
                    }
                },
                {
                    // Style the Category column
                    targets: 2,
                    render: function(data, type, row) {
                        if (type === 'display' && data !== '—') {
                            return '<span class="category-badge">' + data + '</span>';
                        }
                        return data;
                    }
                }
            ]
        });
    });
</script>

</body>
</html>
