<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Print - Activity Summary</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
            line-height: 1.6;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #555;
        }

        .card-body {
            text-align: center;
            margin-bottom: 20px;
        }

        .card-text strong {
            color: #007bff;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td.text-center {
            text-align: center;
        }

        /* Print Media */
        @media print {
            .no-print {
                display: none;
            }

            table th, table td {
                page-break-inside: avoid;
            }
        }

        /* Button Styles */
        .no-print {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .no-print:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Activity Summary</h1>
    <h2>{{ $start_date }} - {{ $end_date }}</h2>
    <div class="card-body">
        <p class="card-text">
            Activities completed by <strong>{{ Auth::user()->name }}</strong>
        </p>
        <p class="card-text">
            Unit: <strong>{{ Auth::user()->unit->name }}</strong>
        </p>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
                <th>Submitter</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($activities as $index => $activity)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>{{ $activity->date }}</td>
                    <td>{{ ucfirst($activity->status) }}</td>
                    <td>{{ $activity->submitter }}</td>
                    <td>{{ $activity->comments }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No activities found for the selected dates.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <button class="no-print" onclick="window.print()">Print</button>
</body>
</html>
