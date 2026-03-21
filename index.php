<?php
//Initialize the Google Client first to avoid the null error
require_once 'vendor/autoload.php';

$clientID = '1010060076471-3drv39bou44hmvm2lur96bmjnuak7t7k.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/NDTBS/google-callback.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
$client->setPrompt('select_account'); 

// Variable is now initialized properly
$login_url = $client->createAuthUrl();

$pageTitle = "NDTBS - Login";
include 'src/includes/header.php'; 
?>

<div class="min-h-screen w-full flex items-center justify-center md:justify-end md:pr-20 bg-cover bg-center bg-no-repeat" 
     style="background-image: url('public/assets/dolpen.jpg');">
    
    <div id="loginForm" class="bg-white/10 backdrop-blur-lg border border-white/20 p-10 rounded-[3rem] shadow-2xl w-full max-w-md text-center">
        
    <?php if (isset($_GET['reset']) && $_GET['reset'] == 'success'): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-full mb-6 text-sm font-bold animate-pulse">
            Password updated successfully! Please log in.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-full mb-6 text-sm font-bold">
            Invalid credentials. Please try again.
        </div>
    <?php endif; ?>

        <h1 class="text-white text-2xl font-bold mb-8 leading-tight drop-shadow-lg">
            Negros Oriental Dolphin<br>Ticket Booking System
        </h1>

        <form action="actions/signin_proc.php" method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="USERNAME" required 
                   class="w-full px-6 py-3 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400 transition">
            
            <input type="password" name="password" placeholder="PASSWORD" required 
                   class="w-full px-6 py-3 rounded-full bg-white/90 text-gray-700 outline-none focus:ring-2 focus:ring-blue-400 transition">
            
            <button type="submit" class="w-full bg-[#90FF7E] hover:bg-[#76E664] text-gray-900 font-bold py-3 rounded-full shadow-lg transition duration-300">
                LOG IN
            </button>
        </form>

        <div class="mt-4">
            <a href="forgot_password.php" class="text-blue-400 text-xs font-bold hover:underline">FORGOTTEN PASSWORD?</a>
        </div>

        <div class="border-t border-white/20 my-6"></div>

        <div class="space-y-3">
            <button onclick="window.location.href='sign_up.php'" 
                    class="w-full bg-white hover:bg-gray-100 text-gray-900 font-bold py-3 rounded-full shadow-md transition duration-300 uppercase">
                Create Account
            </button>
            
            <button onclick="window.location.href='<?= $login_url ?>'" 
                    class="w-full bg-black hover:bg-gray-800 text-white font-bold py-3 rounded-full shadow-md transition duration-300 uppercase">
                Sign in with Google Account
            </button>
        </div>
    </div>
</div>

<?php include 'src/includes/footer.php'; ?>