<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Attendance</title>
</head>
<body>
    <h2>Search Attendance by Date</h2>
    <form method="GET" action="{{ route('admin.search_attendance_by_date') }}">
        <label for="search_date">Select Date:</label>
        <input type="date" id="search_date" name="search_date">
        <button type="submit">Search</button>
    </form>
</body>
</html>
