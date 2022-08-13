<meta name="viewport" content="width=device-width" />
<meta charSet="utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>
    @if(isset($title))
    {{ $title }}
    @else
    {{ config('app.name') }}
    @endif
</title>
<meta property="og:title" content="HIDENSEEK.GAMES" />
<meta property="og:description" content="PLAY & EARN GAMING IN THE REAL WORLD" />
<meta property="og:image" content="{{ asset('images/hns.gif') }}">
<meta property="og:image:type" content="image/gif">
<meta property="og:url" content="https://hidenseek.games/" />
<meta name="twitter:site" content="@hidenseek_games" />

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('images/site.webmanifest') }}">



<meta name="robots" content="index,follow" />
<meta property="og:title" content="HIDENSEEK.GAMES" />
<meta property="og:description" content="PLAY & EARN GAMING IN THE REAL WORLD" />
<meta property="og:url" content="https://hidenseek.games" />
<meta property="og:type" content="website" />
<meta property="og:image:alt" content="HIDENSEEK.GAMES" />
<meta property="og:image:width" content="800" />
<meta property="og:image:height" content="600" />
<meta name="next-head-count" content="24" />
<meta name="msapplication-TileColor" content="#da532c" />
<meta name="theme-color" content="#000000" />
<meta name="description" content="PLAY & EARN GAMING IN THE REAL WORLD" />
<link rel="shortcut icon" />
<link rel="apple-touch-icon" sizes="180x180" />
<meta name="msapplication-TileColor" content="#da532c" />
<meta name="theme-color" content="#ffffff" />
<meta name="theme-color" content="#000000" />


{{-- <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> --}}
<link rel="preload" href="https://decentral.games/_next/static/css/14b6afc48ba56a11.css" as="style"/>
<link rel="stylesheet" href="https://decentral.games/_next/static/css/14b6afc48ba56a11.css" data-n-g=""/>
<link rel="preload" href="https://decentral.games/_next/static/css/7b1208e7a7b9a565.css" as="style"/>
<link rel="stylesheet" href="https://decentral.games/_next/static/css/7b1208e7a7b9a565.css" data-n-p=""/>
<link rel="preload" href="https://decentral.games/_next/static/css/0d999f051cbbd0e5.css" as="style"/>
<link rel="stylesheet" href="https://decentral.games/_next/static/css/0d999f051cbbd0e5.css" data-n-p=""/>
<link rel="preload" href="https://decentral.games/_next/static/css/19be72d9c8a2b043.css" as="style"/>
<link rel="stylesheet" href="https://decentral.games/_next/static/css/19be72d9c8a2b043.css" data-n-p=""/>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<noscript data-n-css=""></noscript>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YED843SXDX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-YED843SXDX');
</script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
crossorigin=""></script>
<script>
  window.Laravel = {!! json_encode([
      'csrfToken'=> csrf_token(),
      'user'=> [
          'authenticated' => auth()->check(),
          'id' => auth()->check() ? auth()->user()->id : null,
          'username' => auth()->check() ? auth()->user()->username : null,
          ]
      ])
  !!};
</script>

<style type="text/css">
#map { height: 180px; }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/DataTableManager.js') }}"></script>

<style id="__jsx-b3907e65894ec280">
  body {
    background: black
  }
</style>
<style data-href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap">
  @font-face {
    font-family: 'Shadows Into Light';
    font-style: normal;
    font-weight: 400;
    font-display: swap;
    src: url(https://fonts.gstatic.com/s/shadowsintolight/v15/UqyNK9UOIntux_czAvDQx_ZcHqZXBNQDcQ.woff) format('woff')
  }

  @font-face {
    font-family: 'Shadows Into Light';
    font-style: normal;
    font-weight: 400;
    font-display: swap;
    src: url(https://fonts.gstatic.com/s/shadowsintolight/v15/UqyNK9UOIntux_czAvDQx_ZcHqZXBNQzdcD55TecYQ.woff2) format('woff2');
    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD
  }
</style>
