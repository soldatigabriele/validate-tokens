<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monitor</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th {
        padding: 5px 10px;
        }
        td {
        padding: 0px 10px;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <th>Id</th>
            <th>Value</th>
            <th>IP</th>
            <th>Attempts</th>
            <th>Last attempt</th>
            <th>Date</th>
        </thead>
        <tbody>
            @foreach($words as $word)
            <tr>
                <td>
                    {{ $word->id }}
                </td>
                <td>
                    {{ $word->value }}
                </td>
                <td>
                    {{ $word->ip ?? '-' }}
                </td>
                <td>
                    {{ $word->attempts ?? 0 }}
                </td>
                <td>
                    {{ $word->updated_at->format('d/m H:i') ?? '' }}
                </td>
                <td>
                    {{ $word->created_at->format('d/m H:i') ?? '' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>