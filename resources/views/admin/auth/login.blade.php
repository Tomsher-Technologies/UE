<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=!, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <x-form.error name="login" />
        <x-form.input name="email" type="email" text="Email" />
        <x-form.input name="password" type="password" text="Password" />
        <input type="submit" value="Submit">
    </form>

</body>

</html>
