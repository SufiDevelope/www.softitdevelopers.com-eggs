@include('project.header')
<br><br><br><br>
<h3 style="text-align:center;color:rgb(184, 139, 116);"><strong> Add a Review</strong></h3>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" id="yelpDataContainer">
            <!-- This is where the Yelp data will be displayed -->
        </div>
    </div>
</div>
<br><br>
<div id="yelpDataContainer"></div>

<!-- Include jQuery library -->
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Your HTML code -->

<script>
$(document).ready(function () {
    // Make an AJAX request to your Laravel route
    $.ajax({
        url: 'http://localhost:8000/yelp-recent-reviews', // Update this URL to your Laravel route
        method: 'GET',
        success: function (response) {
            // Update the content of the yelpRecentReviewsContainer div with the response
            $('#yelpRecentReviewsContainer').html(response);
        },
        error: function (error) {
            console.error('Error fetching recent reviews from Yelp:', error);
        }
    });
});
</script>

<!-- Display the recent reviews in this container -->
<div id="yelpRecentReviewsContainer"></div>
<!-- Your HTML code continues -->

<!-- Your HTML code continues -->


<br><br><br><br>
<footer style="background-color:#EEEEEE;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <br>
                <small> COPYRIGHT © 2024 EGGS BENEDICT NEAR ME - ALL RIGHTS RESERVED. </small>
                <br><br>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <br>
                <small>POWERED BY MEDEX</small>
                <br><br>
            </div>
        </div>
    </div>
</footer>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Website</title>
  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<!-- Your website content -->

<!-- Review Form -->
<form id="reviewForm">
  <label for="reviewText">Write a Review:</label>
  <textarea id="reviewText" name="reviewText" rows="4" cols="50"></textarea>
  <br>
  <button type="button" onclick="submitReview()">Submit Review</button>
</form>

<!-- Script to Submit Review -->
<script>
  function submitReview() {
    // Get the review text from the form
    var reviewText = $('#reviewText').val();

    // Example API endpoint (replace with Yelp's actual API endpoint)
    var apiUrl = 'https://api.yelp.com/v3/businesses/{YOUR_BUSINESS_ID}/reviews';

    // Example Yelp API Key (replace with your actual Yelp API Key)
    var apiKey = 'YOUR_YELP_API_KEY';

    // Make an AJAX request to Yelp API to submit the review
    $.ajax({
      url: apiUrl,
      method: 'POST',
      headers: {
        'Authorization': 'Bearer ' + apiKey,
        'Content-Type': 'application/json',
      },
      data: JSON.stringify({
        text: reviewText,
        // Add other required parameters as needed
      }),
      success: function(response) {
        // Handle success - review submitted
        console.log('Review submitted successfully:', response);

        // You may want to refresh the reviews on your website after submission
        // Call a function to fetch and display reviews
        fetchAndDisplayReviews();
      },
      error: function(error) {
        // Handle error
        console.error('Error submitting review:', error);
      }
    });
  }

  // Function to fetch and display reviews (replace with your implementation)
  function fetchAndDisplayReviews() {
    // Implement logic to fetch reviews and update your website's UI
    // This might involve another API request to get reviews from Yelp
    console.log('Fetching and displaying reviews...');
  }
</script>

</body>
</html>

