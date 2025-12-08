<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>
<meta name="description" content="{{$meta_description ?? ''}}">

<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:locale" content="fa_IR">

<meta property="og:title" content="{{$og_title ?? ''}}">
<meta property="og:description" content="{{$og_description ?? ''}}">

<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="آموزشگاه آی تک">

<meta property="og:image" content="{{ asset('images/og-home.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{$tw_title ?? ''}}">
<meta name="twitter:description" content="{{$tw_description ?? ''}}">
<meta name="twitter:image" content="{{ asset('images/og-home.jpg') }}">
<!-- JSON-LD -->

<script type="application/ld+json">
    {!! json_encode([
        "@@context" => "https://schema.org",
        "@type" => "EducationalOrganization",
        "@id" => url('/') . "#organization",
        "name" => "آموزشگاه آی‌تک",
        "url" => url('/'),
        "logo" => asset('images/logo.png'),
        "image" => asset('images/og-home.jpg'),
        "description" => "آموزشگاه تخصصی کامپیوتر، حسابداری، برنامه‌نویسی، معماری و عکاسی در بوشهر با دوره‌های مهارتی کاربردی و آموزش حضوری.",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "خیابان سنگی، ابتدای کوچه گلخانه",
            "addressLocality" => "بوشهر",
            "addressRegion" => "بوشهر",
            "postalCode" => "75148",
            "addressCountry" => "IR"
        ],
        "telephone" => "+98-935-056-8163",
        "priceRange" => "$$",
        "sameAs" => [
            "https://www.instagram.com/itec_academy",
            "https://t.me/itec_academy"
        ]
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>


@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
