<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Twilio SMS Callback Example</title>
</head>
<body>
<div class="col-lg-8 mx-auto p-3 py-md-5">
    <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <span class="fs-4">Twilio SMS Callback Example</span>
        </a>
    </header>

    <main>
        <h1>Send SMS</h1>
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-6">
                <form method="post">
                    @csrf
                    <div class="col-3 mb-3">
                        <label for="toNumber" class="form-label">To Number</label>
                        <input type="text" class="form-control" id="toNumber" name="toNumber" placeholder="+16126551234">
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Message Body</label>
                        <input type="text" class="form-control" id="body" name="body">
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>

        <hr class="col-3 col-md-2 mb-5">

        <div class="row g-5">
            <div class="col-md-12">
                <h2>SMS Status Callbacks</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Message SID</th>
                        <th scope="col">To</th>
                        <th scope="col">From</th>
                        <th scope="col">Status</th>
                        <th scope="col">Error Code</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($smsStatuses as $smsStatus)
                    <tr>
                        <th scope="row">{{$smsStatus->message_sid}}</th>
                        <td>{{$smsStatus->to_number}}</td>
                        <td>{{$smsStatus->from_number}}</td>
                        <td>{{$smsStatus->status}}</td>
                        <td><a href="https://www.twilio.com/docs/api/errors/{{$smsStatus->error_code}}" target="_blank">{{$smsStatus->error_code}}</td>
                        <td>{{$smsStatus->created_at}}</td>
                        <td>{{$smsStatus->updated_at}}</td>
                    </tr>
                    @empty
                        <td colspan="6">No Statuses Found</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
