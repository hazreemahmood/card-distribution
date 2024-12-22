<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Distribution</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>

    <div class="flex-center position-ref full-height">

        <h1>Distribute Cards to Players</h1>
        
        <form id="card-form" method="POST" action="{{ route('distribute.cards') }}">
            @csrf
            <label for="people">Number of People:</label>
            <input type="number" name="people" id="people" required min="1" max="53" placeholder="Enter number of people">
            <button type="submit">Distribute Cards</button>
        </form>
        
        <div id="result" style="margin-top: 20px;">
            <!-- Cards will be displayed here -->
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#result').hide();
        })
        // Handle form submission via AJAX to prevent page reload
        $('#card-form').submit(function(event) {
            event.preventDefault();
            const numPeople = $('#people').val();

            // Validate input
            if (numPeople <= 0 || numPeople > 53) {
                alert("Input value does not exist or value is invalid");
                return;
            }

            // Send AJAX request to distribute cards
            $.ajax({
                type: 'POST',
                url: '{{ route("distribute.cards") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    people: numPeople
                },
                success: function(response) {
                    // Display the result of card distribution
                    if (response.status === 'success') {
                        let resultHtml = '';
                        response.data.forEach((cards, index) => {
                            resultHtml += 'Player ' + (index + 1) + ': ' + cards.join(', ') + '<br>';
                        });
                        $('#result').show();
                        $('#result').html(resultHtml);
                    }
                },
                error: function() {
                    // Display error message if card distribution fails
                    alert("Error while distributing cards.");
                }
            });
        });
    </script>

</body>
</html>
