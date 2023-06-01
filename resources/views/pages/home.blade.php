<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <main>
        @include('partials.pages.navbar')

        <div class="p-5 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Get Started</h1>
                <p class="col-md-8 fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime nostrum omnis
                    suscipit corrupti, odit eius. Ex optio et asperiores iusto autem consequuntur nam illo nisi, nulla,
                    amet fugit ducimus magnam!</p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4>Prepare</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem iure inventore suscipit quisquam debitis quo odit? Vero doloribus soluta architecto atque ex in dicta eum eaque dignissimos. Repudiandae, labore rem.</p>
                            <a href="{{ route('select.subject') }}" class="btn btn-dark">Start</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
