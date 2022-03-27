<!DOCTYPE html>
<html lang="en">
@include("fixed.back.head")
<body>
@include("fixed.back.nav")

@yield("content")


@include("fixed.back.footer")

@section("scripts")
@include("fixed.back.scripts")
@show

</body>

</html>

