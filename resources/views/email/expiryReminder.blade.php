<!DOCTYPE html>
<html>
<head>
    <title>Ebook.com</title>
</head>
<body>
<p> Hi</p> <h3> {{$mailData['username']}} </h3>
    <p>This is an email reminder about the book : {{$mailData['book_name']}} which is going to expire today, .i.e {{$mailData['expiry_date']}}</p>
    <p> If you donnot wish extend the loan period, Please cancel/return the book.</p>    
    <p>Thank you</p>
</body>
</html>