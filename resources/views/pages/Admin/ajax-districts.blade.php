    <div class="input-group md-form form-sm form-2 pl-0">
        <select name="district_id" id="district_id" class="form-control my-0 py-1 amber-border">
            <option value="">Districts</option>
            @foreach($districts as $district)
                        <option value="{{$district->id}}">{{$district->name}}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                    aria-hidden="true"></i></span>
        </div>
    </div>

