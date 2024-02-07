@if (isset($permissions) && !empty($permissions))
    <div class="container">
        <div class="row">
            @foreach ($permissions as $index => $permission)
                @if ($index % 4 == 0)
                    @php
                        $listPermission = isset($permissions[$index]) ? $permissions[$index]->name : '';
                        $createPermission = isset($permissions[$index + 1]) ? $permissions[$index + 1]->name : '';
                        $editPermission = isset($permissions[$index + 2]) ? $permissions[$index + 2]->name : '';
                        $deletePermission = isset($permissions[$index + 3]) ? $permissions[$index + 3]->name : '';
                    @endphp
                    <div class="wrapper my-1 d-flex">
                        @if (!empty($listPermission))
                            <div class="form-check col-md-3">
                                <input class="form-check-input permission_input" type="checkbox"
                                    id="edit_{{ $listPermission }}" name="permissions[{{ $listPermission }}]"
                                    {{ in_array($listPermission, $rolePermissions) ? 'checked' : '' }} @if (isset($type) && $type=="readonly") disabled readonly @endif/>
                                <label class="form-check-label" for="edit_{{ $listPermission }}">
                                    {{ $listPermission }}
                                </label>
                            </div>
                        @endif
                        @if (!empty($createPermission))
                            <div class="form-check col-md-3">
                                <input class="form-check-input permission_input" type="checkbox"
                                    id="edit_{{ $createPermission }}" name="permissions[{{ $createPermission }}]"
                                    {{ in_array($createPermission, $rolePermissions) ? 'checked' : '' }} @if (isset($type) && $type=="readonly") disabled readonly @endif/>
                                <label class="form-check-label" for="edit_{{ $createPermission }}">
                                    {{ $createPermission }}
                                </label>
                            </div>
                        @endif
                        @if (!empty($editPermission))
                            <div class="form-check col-md-3">
                                <input class="form-check-input permission_input" type="checkbox"
                                    id="edit_{{ $editPermission }}" name="permissions[{{ $editPermission }}]"
                                    {{ in_array($editPermission, $rolePermissions) ? 'checked' : '' }} @if (isset($type) && $type=="readonly") disabled readonly @endif/>
                                <label class="form-check-label" for="edit_{{ $editPermission }}">
                                    {{ $editPermission }}
                                </label>
                            </div>
                        @endif
                        @if (!empty($deletePermission))
                            <div class="form-check col-md-3">
                                <input class="form-check-input permission_input" type="checkbox"
                                    id="edit_{{ $deletePermission }}" name="permissions[{{ $deletePermission }}]"
                                    {{ in_array($deletePermission, $rolePermissions) ? 'checked' : '' }} @if (isset($type) && $type=="readonly") disabled readonly @endif/>
                                <label class="form-check-label" for="edit_{{ $deletePermission }}">
                                    {{ $deletePermission }}
                                </label>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif
