<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA Compatible" content="ie=edge">
    <title>Document</title>
</head>    
<body>
    <h1>Enter student details</h1>
    <form method="post" action="{{route('profile.store')}}">
        @csrf
        @method('post')
        <div>
            <label>Student name</label>
           <input type="name" name="name" placeholder="Name">
        </div>
        <div>
            <input type="submit" value="Save">
        </div>

    </form>    
</body>
</html>