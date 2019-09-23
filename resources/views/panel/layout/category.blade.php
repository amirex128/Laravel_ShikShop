<select name="{{$name}}[]" multiple
        class="custom-select form-control form-control-alternative{{ $errors->has('parent') ? ' is-invalid' : '' }}">
    @foreach(\App\model\Category::with('childs')->where('parent',0)->get() as $category)
        <option value="{{$category->id}}">
            ---->{{$category->name}}</option>

        @foreach(\App\model\Category::with('childs')->where('parent',1)->get() as $category1)
            <option value="{{$category1['id']}}">
                --------> {{$category1['name']}}</option>

            @foreach(\App\model\Category::with('childs')->where('parent',2)->get() as $category2)
                <option value="{{$category2['id']}}">
                    ------------> {{$category2['name']}}</option>parent

                @foreach(\App\model\Category::with('childs')->where('parent',3)->get() as $category3)
                    <option value="{{$category3['id']}}">
                        ----------------> {{$category3['name']}}</option>

                    @foreach(\App\model\Category::with('childs')->where('parent',4)->get() as $category4)
                        <option
                                value="{{$category4['id']}}">
                            --------------------> {{$category4['name']}}</option>
                        @foreach(\App\model\Category::with('childs')->where('parent',5)->get() as $category5)
                            <option
                                    value="{{$category5['id']}}">
                                ------------------------> {{$category5['name']}}</option>
                            @foreach(\App\model\Category::with('childs')->where('parent',6)->get() as $category6)
                                <option
                                        value="{{$category6['id']}}">
                                    ----------------------------> {{$category6['name']}}</option>
                                @foreach(\App\model\Category::with('childs')->where('parent',7)->get() as $category7)
                                    <option
                                            value="{{$category7['id']}}">
                                        --------------------------------> {{$category7['name']}}</option>
                                    @foreach(\App\model\Category::with('childs')->where('parent',8)->get() as $category8)
                                        <option
                                                value="{{$category8['id']}}">
                                            ------------------------------------> {{$category8['name']}}</option>
                                        @foreach(\App\model\Category::with('childs')->where('parent',9)->get() as $category9)
                                            <option
                                                    value="{{$category9['id']}}">
                                                ----------------------------------------> {{$category9['name']}}</option>
                                            @foreach(\App\model\Category::with('childs')->where('parent',10)->get() as $category10)
                                                <option
                                                        value="{{$category10['id']}}">
                                                    --------------------------------------------> {{$category10['name']}}</option>
                                                @foreach(\App\model\Category::with('childs')->where('parent',11)->get() as $category11)
                                                    <option
                                                            value="{{$category11['id']}}">
                                                        ------------------------------------------------> {{$category11['name']}}</option>
                                                    @foreach(\App\model\Category::with('childs')->where('parent',12)->get() as $category12)
                                                        <option
                                                                value="{{$category12['id']}}">
                                                            ----------------------------------------------------> {{$category12['name']}}</option>

                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach

                            @endforeach

                        @endforeach

                    @endforeach

                @endforeach

            @endforeach

        @endforeach

    @endforeach

</select>
