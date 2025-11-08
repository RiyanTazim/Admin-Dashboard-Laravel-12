@extends('Backend.master')

@section('title', 'System Setting')

@section('content')
    <div class="app-content content ">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">System Setting</h3>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{ route('system.settings') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="country">Logo</label>
                                <input class="form-control dropify" type="file" name="logo"
                                    @isset($setting->logo)
                                                   data-default-file="{{ asset($setting->logo) }}"
                                    @endisset>
                                @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="country">Favicon</label>
                                <input class="form-control dropify" type="file" name="favicon"
                                    @isset($setting->favicon)
                                                data-default-file="{{ asset($setting->favicon) }}"
                                    @endisset>
                                @error('favicon')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Title</label>
                                        <input type="text" id="system_title" class="form-control"
                                            value="{{ $setting->system_title ?? '' }}" placeholder="System title"
                                            name="system_title" />
                                        @error('system_title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="city-column">Company Address</label>
                                        <input type="text" id="tag_line" class="form-control"
                                            value="{{ $setting->tag_line ?? '' }}" placeholder="Head Office Address"
                                            name="tag_line" />
                                        @error('tag_line')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="city-column">Company Name</label>
                                        <input type="text" id="company_name" class="form-control"
                                            value="{{ $setting->company_name ?? ''}}" placeholder="company name"
                                            name="company_name" />
                                        @error('company_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="phone-floating">Phone Number</label>
                                        <div class="input-group">
                                            <select class="custom-select select2-size-lg" id="country-code"
                                                name="phone_code">
                                                <option value="+1"
                                                    {{ $setting?->phone_code === '+1' ? 'selected' : '' }}>+1
                                                    (USA)
                                                </option>
                                                <option value="+1"
                                                    {{ $setting?->phone_code === '+1' ? 'selected' : '' }}>+1
                                                    (Canada)</option>
                                                <option value="+44"
                                                    {{ $setting?->phone_code === '+44' ? 'selected' : '' }}>+44
                                                    (United Kingdom)</option>
                                                <option value="+91"
                                                    {{ $setting?->phone_code === '+91' ? 'selected' : '' }}>+91
                                                    (India)</option>
                                                <option value="+61"
                                                    {{ $setting?->phone_code === '+61' ? 'selected' : '' }}>+61
                                                    (Australia)</option>
                                                <option value="+81"
                                                    {{ $setting?->phone_code === '+81' ? 'selected' : '' }}>+81
                                                    (Japan)</option>
                                                <option value="+49"
                                                    {{ $setting?->phone_code === '+49' ? 'selected' : '' }}>+49
                                                    (Germany)</option>
                                                <option value="+33"
                                                    {{ $setting?->phone_code === '+33' ? 'selected' : '' }}>+33
                                                    (France)</option>
                                                <option value="+34"
                                                    {{ $setting?->phone_code === '+34' ? 'selected' : '' }}>+34
                                                    (Spain)</option>
                                                <option value="+39"
                                                    {{ $setting?->phone_code === '+39' ? 'selected' : '' }}>+39
                                                    (Italy)</option>
                                                <option value="+55"
                                                    {{ $setting?->phone_code === '+55' ? 'selected' : '' }}>+55
                                                    (Brazil)</option>
                                                <option value="+7"
                                                    {{ $setting?->phone_code === '+7' ? 'selected' : '' }}>+7
                                                    (Russia)</option>
                                                <option value="+86"
                                                    {{ $setting?->phone_code === '+86' ? 'selected' : '' }}>+86
                                                    (China)</option>
                                                <option value="+91"
                                                    {{ $setting?->phone_code === '+91' ? 'selected' : '' }}>+91
                                                    (India)</option>
                                                <option value="+62"
                                                    {{ $setting?->phone_code === '+62' ? 'selected' : '' }}>+62
                                                    (Indonesia)</option>
                                                <option value="+971"
                                                    {{ $setting?->phone_code === '+971' ? 'selected' : '' }}>
                                                    +971
                                                    (United Arab Emirates)</option>
                                                <option value="+52"
                                                    {{ $setting?->phone_code === '+52' ? 'selected' : '' }}>+52
                                                    (Mexico)</option>
                                                <option value="+20"
                                                    {{ $setting?->phone_code === '+20' ? 'selected' : '' }}>+20
                                                    (Egypt)</option>
                                                <option value="+27"
                                                    {{ $setting?->phone_code === '+27' ? 'selected' : '' }}>+27
                                                    (South Africa)</option>
                                                <option value="+66"
                                                    {{ $setting?->phone_code === '+66' ? 'selected' : '' }}>+66
                                                    (Thailand)</option>
                                                <option value="+63"
                                                    {{ $setting?->phone_code === '+63' ? 'selected' : '' }}>+63
                                                    (Philippines)</option>
                                                <option value="+55"
                                                    {{ $setting?->phone_code === '+55' ? 'selected' : '' }}>+55
                                                    (Brazil)</option>
                                                <option value="+98"
                                                    {{ $setting?->phone_code === '+98' ? 'selected' : '' }}>+98
                                                    (Iran)</option>
                                                <option value="+90"
                                                    {{ $setting?->phone_code === '+90' ? 'selected' : '' }}>+90
                                                    (Turkey)</option>
                                                <option value="+82"
                                                    {{ $setting?->phone_code === '+82' ? 'selected' : '' }}>+82
                                                    (South Korea)</option>
                                                <option value="+34"
                                                    {{ $setting?->phone_code === '+34' ? 'selected' : '' }}>+34
                                                    (Spain)</option>
                                                <option value="+32"
                                                    {{ $setting?->phone_code === '+32' ? 'selected' : '' }}>+32
                                                    (Belgium)</option>
                                                <option value="+31"
                                                    {{ $setting?->phone_code === '+31' ? 'selected' : '' }}>+31
                                                    (Netherlands)</option>
                                                <option value="+47"
                                                    {{ $setting?->phone_code === '+47' ? 'selected' : '' }}>+47
                                                    (Norway)</option>
                                                <option value="+48"
                                                    {{ $setting?->phone_code === '+48' ? 'selected' : '' }}>+48
                                                    (Poland)</option>
                                                <option value="+41"
                                                    {{ $setting?->phone_code === '+41' ? 'selected' : '' }}>+41
                                                    (Switzerland)</option>
                                                <option value="+46"
                                                    {{ $setting?->phone_code === '+46' ? 'selected' : '' }}>+46
                                                    (Sweden)</option>
                                                <option value="+45"
                                                    {{ $setting?->phone_code === '+45' ? 'selected' : '' }}>+45
                                                    (Denmark)</option>
                                                <option value="+354"
                                                    {{ $setting?->phone_code === '+354' ? 'selected' : '' }}>
                                                    +354
                                                    (Iceland)</option>
                                                <option value="+351"
                                                    {{ $setting?->phone_code === '+351' ? 'selected' : '' }}>
                                                    +351
                                                    (Portugal)</option>
                                                <option value="+353"
                                                    {{ $setting?->phone_code === '+353' ? 'selected' : '' }}>
                                                    +353
                                                    (Ireland)</option>
                                                <option value="+93"
                                                    {{ $setting?->phone_code === '+93' ? 'selected' : '' }}>+93
                                                    (Afghanistan)</option>
                                                <option value="+994"
                                                    {{ $setting?->phone_code === '+994' ? 'selected' : '' }}>
                                                    +994
                                                    (Azerbaijan)</option>
                                                <option value="+1"
                                                    {{ $setting?->phone_code === '+1' ? 'selected' : '' }}>+1
                                                    (Bahrain)</option>
                                                <option value="+880"
                                                    {{ $setting?->phone_code === '+880' ? 'selected' : '' }}>
                                                    +880
                                                    (Bangladesh)</option>
                                                <option value="+975"
                                                    {{ $setting?->phone_code === '+975' ? 'selected' : '' }}>
                                                    +975
                                                    (Bhutan)</option>
                                                <option value="+855"
                                                    {{ $setting?->phone_code === '+855' ? 'selected' : '' }}>
                                                    +855
                                                    (Cambodia)</option>
                                                <option value="+86"
                                                    {{ $setting?->phone_code === '+86' ? 'selected' : '' }}>+86
                                                    (China)</option>
                                                <option value="+357"
                                                    {{ $setting?->phone_code === '+357' ? 'selected' : '' }}>
                                                    +357
                                                    (Cyprus)</option>
                                                <option value="+61"
                                                    {{ $setting?->phone_code === '+61' ? 'selected' : '' }}>+61
                                                    (Georgia)</option>
                                                <option value="+91"
                                                    {{ $setting?->phone_code === '+91' ? 'selected' : '' }}>+91
                                                    (India)</option>
                                                <option value="+62"
                                                    {{ $setting?->phone_code === '+62' ? 'selected' : '' }}>+62
                                                    (Indonesia)</option>
                                                <option value="+98"
                                                    {{ $setting?->phone_code === '+98' ? 'selected' : '' }}>+98
                                                    (Iran)</option>
                                                <option value="+81"
                                                    {{ $setting?->phone_code === '+81' ? 'selected' : '' }}>+81
                                                    (Japan)</option>
                                                <option value="+962"
                                                    {{ $setting?->phone_code === '+962' ? 'selected' : '' }}>
                                                    +962
                                                    (Jordan)</option>
                                                <option value="+961"
                                                    {{ $setting?->phone_code === '+961' ? 'selected' : '' }}>
                                                    +961
                                                    (Lebanon)</option>
                                                <option value="+960"
                                                    {{ $setting?->phone_code === '+960' ? 'selected' : '' }}>
                                                    +960
                                                    (Maldives)</option>
                                                <option value="+60"
                                                    {{ $setting?->phone_code === '+60' ? 'selected' : '' }}>+60
                                                    (Malaysia)</option>
                                                <option value="+965"
                                                    {{ $setting?->phone_code === '+965' ? 'selected' : '' }}>
                                                    +965
                                                    (Kuwait)</option>
                                            </select>

                                            <input type="text" class="form-control" id="phone_number"
                                                name="phone_number" value="{{ $setting->phone_number ?? '' }}"
                                                placeholder="Enter your phone number">
                                        </div>
                                        @error('phone_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control" name="email"
                                            value="{{ $setting->email ?? '' }}" placeholder="Email" />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Opening Hours</label>
                                        <textarea id="system_short_title" class="ck-editor form-control" name="system_short_title">{{ $setting->system_short_title ?? '' }}</textarea>
                                        @error('system_short_title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-primary mr-1">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
