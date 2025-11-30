
        <select name="city_id" id="city_id" class="form-control" >
            <option value="">City</option>
            @foreach($cities as $city)
                        <option value="{{$city->city_id}}">{{$city->city_name}}</option>
            @endforeach
        </select>


