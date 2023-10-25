<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Enter student details</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

        @endif
    </div>
    <form method="post" action="{{route('student.store')}}">
        @csrf
        @method('post')
        <div>
            <label>Student Id</label>
            <input type="number" name="s_id" placeholder="Student Id">
        </div>
        <div>
            <label>Gender</label>
            <input type="checkbox" id="male" name="gender" value="0">
            <label for="male">M</label>
            <input type="checkbox" id="female" name="gender" value="1">
            <label for="female">F</label>
        </div>
        <div>
            <label>Age</label>
            <input type="number" name="age" placeholder="Age">
        </div>
        <div>
            <label>Absences</label>
            <input type="number" name="absences" placeholder="No of absences">
        </div>
        <div>
            <label>First term</label>
            <input type="number" name="firstterm" placeholder="First term mark">
        </div>
        <div>
            <label>Second term</label>
            <input type="number" name="secondterm" placeholder="Second term mark">
        </div>
        <div>
            <label>Third term</label>
            <input type="number" name="thirdterm" placeholder="Third term mark">
        </div>
        <div>
            <input type="submit" value="Save student details">
        </div>

    </form>
</body>
</html>