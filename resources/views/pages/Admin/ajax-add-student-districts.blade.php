
        <select name="district_id" id="district_id" onchange="getCity(this)" class="form-control" >
            <option value="">Districts</option>
            @foreach($districts as $district)
                        <option value="{{$district->id}}">{{$district->name}}</option>
            @endforeach
        </select>


