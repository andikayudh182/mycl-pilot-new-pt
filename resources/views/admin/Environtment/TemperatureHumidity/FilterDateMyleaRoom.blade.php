<div class="collapse mt-1" id="collapseFilterDate">
    <div class="card card-body" style="width:100%;">
        <form action="{{ route('temperature-humidity.mylea') }}" method="GET">
            <div id="FormDate">
                <div class="row mb-3 ">
                    <label for="StartDate" class="col-sm-2 col-form-label col-form-label-sm">Start Date :</label>
                    <div class="col-md-5">
                        <input type="date" name="StartDate" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['StartDate'])){{$_GET['StartDate']}}@endif" required>
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="EndDate" class="col-sm-2 col-form-label col-form-label-sm">End Date :</label>
                    <div class="col-md-5">
                        <input type="date" name="EndDate" class="form-control form-control-sm " id="colFormLabelSm" value="@if(isset($_GET['EndDate'])){{$_GET['EndDate']}}@endif" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-5"  style="backgorund-color:red;" >
                        <button type="Submit" name="Filter" class="btn btn-primary" value="1" style="width:68vh;">Filter Data</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>