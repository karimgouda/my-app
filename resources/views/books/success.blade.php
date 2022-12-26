
@if(session()->has("success"))

    <p class=" alert alert-success w-50 m-auto mt-5 ">{{session()->get("success")}}</p>

@endif
