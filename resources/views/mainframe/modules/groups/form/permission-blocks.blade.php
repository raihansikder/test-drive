<h4>Permissions</h4>
<div class="row">
    <div id="vue_root_permission" class="permissions-tree">
        <ul>

            {{--Super user permission--}}
            <li class="superuser col-md-12">
                <label>
                    <input name='permission[]' type='checkbox' v-model='permission' value='superuser'
                           data-toggle="tooltip" title="Assign super admin permission"/>
                    <b>Super user</b>
                </label>
            </li>

            {{-- Module view, create, edit permissions--}}
            <li class="module-permissions">
                {!!  \App\ModuleGroup::renderTree() !!}
            </li>

            {{--Additional permission options defined in config/mainframe/permissions--}}
            <?php
            $customPermissionItems = config('mainframe.permissions.custom');
            ?>
            @foreach($customPermissionItems as $item => $permissions)
                <div class="clearfix"></div>
                <li class="pull-left">

                    <input name="permission[]" type="checkbox" value="{{$item}}" v-model='permission'
                           v-on:click='clicked'>
                    <label>{{Str::ucfirst(str_replace('-',' ',$item))}}</label>

                    <div class="clearfix"></div>
                    <ul class="pull-left">
                        @foreach($permissions as $key=>$label)
                            <li>
                                <label>
                                    <input name="permission[]" type="checkbox" value="{{$key}}" v-model='permission'>
                                    {{$label}}
                                    <code><small>{{$key}}</small></code>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@section('js')
    @parent
    <!--suppress JSUnusedLocalSymbols -->
    <script>
        enableCascadingSelectionOfPermission();

        /**
         * Function to enable cascading selection/de-selection of child
         * elements in a permission hierarchy
         */
        function enableCascadingSelectionOfPermission() {
            var v = new Vue({
                el: '#vue_root_permission',
                data: {
                    permission: []
                },
                mounted: function () {
                    // get groups permissions and load in vue data array
                    $.ajax({
                        datatype: 'json',
                        method: "GET",
                        url: '{{route('groups.show',$element->id)}}?ret=json',
                        // data: $('form[name=' + form_name + ']').serialize()
                    }).done(function (ret) {
                        ret = parseJson(ret);
                        var arr = [];
                        if (hasNestedKey(ret, 'data', 'permissions')) {
                            $.each(ret.data.permissions, function (k, v) {
                                if (v == 1) arr.push(k)
                            });
                        }
                        v.permission = arr;
                    });
                },
                methods: {
                    clicked: function (e) {
                        // if checkbox is checked then push all the relevant values in array
                        // e.target returns the dom element that has been clicked
                        if ($(e.target).is(":checked")) {
                            $(e.target).parent().find('input').each(function (e) {
                                var val = $(this).val();
                                // check if the value already exists in array. Don't push into array
                                // if the key already exists
                                if (v.permission.indexOf(val) === -1) { // if doesn't exist in array index
                                    v.permission.push(val);
                                }
                            });
                        } else {
                            $(e.target).parent().find('input').each(function (e) {
                                var val = $(this).val();
                                var index = v.permission.indexOf(val);
                                if (index > -1) {
                                    v.permission.splice(index, 1);
                                }
                            });
                        }
                    }
                }
            });
            return v;
        }

    </script>
@stop
