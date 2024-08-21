<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Portfolio Website - KIDIST ENYEW</title>
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/14023f4cc3.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="home">
        <div class="header-text">
            <div>
                <p>Web Developer</p>
                <h1 id="greeting">Hello, I am <span id="user-name"></span><br> from Ethiopia</h1>
            </div>
            <img id="profile-image" src="" alt="Profile Image" height="100" width="200">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/home')
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('user-name').innerText = data.your_name || 'User';
                        document.getElementById('profile-image').src = data.profile ?
                            `{{ url('public/images/') }}/${data.profile}` : 'default-image-path.jpg';
                    } else {
                        document.getElementById('user-name').innerText = 'User';
                        document.getElementById('profile-image').src = 'default-image-path.jpg';
                    }
                })
                .catch(error => console.error('Error fetching user data:', error));
        });
    </script>
</body>

</html>
