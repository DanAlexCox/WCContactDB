<?php
session_start();
include "connectdb.php";

if(isset($_GET['error'])){
    // Sanitize the message to prevent XSS
    $error = htmlspecialchars($_GET['error']);
    // Display a JavaScript alert with the message
    echo "<script>alert('$error');</script>";
}

if(isset($_GET['msg'])){
    // Sanitize the message to prevent XSS
    $msg = htmlspecialchars($_GET['msg']);
    // Display a JavaScript alert with the message
    echo "<script>alert('$msg');</script>";
}

if(!isset($_SESSION['User_ID'])){
    $msg = 'Must sign in again.';
    session_unset();
    session_destroy();
    header("Location: ../loginsystem/login.php?msg=".urlencode($msg));
    exit();
}
?>
<html>
    <head>
        <title>Promotion</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/client.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
        <script src="JS/email.js" defer></script>
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>
        <!-- Select 1 of 3 email promotion designs -->
         <section>
         <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f0f8ff; font-family: 'Segoe UI', sans-serif; padding: 30px;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
        <tr>
          <td style="padding: 25px; text-align: center; background-color: #6cb2eb; color: #ffffff;">
            <h2 style="margin: 0;">Your Mental Wellness Matters</h2>
            <p style="margin: 5px 0 0;">We’re here for you—every step of the way.</p>
          </td>
        </tr>
        <tr>
          <td style="padding: 25px; color: #333;">
            <p>Book a 1-on-1 appointment with our licensed counselors. Whether you need a quick check-in or ongoing support, we’re just a click away.</p>
            <a href="#" style="display: inline-block; margin-top: 15px; padding: 12px 24px; background-color: #38c172; color: #fff; text-decoration: none; border-radius: 5px;">Book Now</a>
          </td>
        </tr>
        <tr>
          <td style="padding: 15px; background-color: #e6f2ff; text-align: center; font-size: 12px; color: #555;">
            Confidential. Compassionate. Completely free.
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

         </section><br>
         <section>
         <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #fefefe; font-family: 'Helvetica Neue', sans-serif; padding: 20px;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 6px;">
        <tr>
          <td style="padding: 20px; text-align: center; background-color: #d4edda; color: #155724;">
            <h2 style="margin: 0;">🌿 Free Community Workshop: Managing Anxiety</h2>
            <p style="margin: 10px 0 0;">Saturday, April 20th @ 10:00AM (Online)</p>
          </td>
        </tr>
        <tr>
          <td style="padding: 25px; color: #333;">
            <p>Join our licensed therapists for a calming session focused on understanding and managing anxiety in daily life. Open to all, no experience needed.</p>
            <ul>
              <li>Mindfulness techniques</li>
              <li>Group support discussion</li>
              <li>Free resources & handouts</li>
            </ul>
            <a href="#" style="display: inline-block; padding: 10px 20px; background-color: #20c997; color: #fff; text-decoration: none; border-radius: 5px;">Reserve Your Spot</a>
          </td>
        </tr>
        <tr>
          <td style="padding: 15px; font-size: 12px; color: #777; text-align: center;">
            This event is hosted by MindCare Charity. All sessions are safe, inclusive, and judgment-free.
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

        </section><br>
        <section>
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #eef2f7; font-family: Verdana, sans-serif; padding: 40px 0;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; overflow: hidden;">
        <tr>
          <td style="padding: 20px; text-align: center; background-color: #adb5bd; color: #ffffff;">
            <h2 style="margin: 0;">🗓️ April Mental Health Activities</h2>
            <p style="margin: 5px 0 0;">Explore what's happening this month</p>
          </td>
        </tr>
        <tr>
          <td style="padding: 25px; color: #333;">
            <table width="100%" cellpadding="10" cellspacing="0">
              <tr>
                <td style="background-color: #f8f9fa; border-radius: 6px;">
                  <strong>April 12 – Art for Calm Workshop</strong><br>
                  In-person | 4:00–6:00PM | Free Supplies
                </td>
              </tr>
              <tr>
                <td style="background-color: #f1f3f5; border-radius: 6px;">
                  <strong>April 18 – Guided Meditation Zoom</strong><br>
                  Virtual | 7:00–8:00PM | Sign-up Required
                </td>
              </tr>
              <tr>
                <td style="background-color: #e9ecef; border-radius: 6px;">
                  <strong>April 25 – Community Walk for Wellness</strong><br>
                  Outdoor | 10:00AM | Meet at Green Park
                </td>
              </tr>
            </table>
            <div style="text-align: center; margin-top: 20px;">
              <a href="#" style="display: inline-block; padding: 10px 20px; background-color: #495057; color: #ffffff; text-decoration: none; border-radius: 4px;">See Full Calendar</a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 15px; text-align: center; font-size: 12px; color: #888;">
            You’re receiving this because you signed up for updates from MindCare Charity. Unsubscribe any time.
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

        </section><br>
        <section>
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f3f7f9; font-family: 'Segoe UI', sans-serif; padding: 30px;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <!-- Header -->
        <tr>
          <td style="background-color: #6c757d; color: #ffffff; padding: 30px; text-align: center;">
            <h2 style="margin: 0;">You're Invited</h2>
            <p style="margin: 10px 0 0; font-size: 16px;">Mental Health Awareness Evening</p>
          </td>
        </tr>
        <!-- Main Content -->
        <tr>
          <td style="padding: 30px; color: #333;">
            <p><strong>Date:</strong> Thursday, April 18, 2025</p>
            <p><strong>Time:</strong> 6:00 PM – 8:30 PM</p>
            <p><strong>Location:</strong> Harmony Community Center, 12 Willow Lane</p>
            <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">
            <p>Join us for an evening of connection, education, and support as we shine a light on mental health in our community. This free event includes:</p>
            <ul>
              <li>Guest speakers with lived experience</li>
              <li>Guided relaxation activities</li>
              <li>Resource booths and support sign-ups</li>
              <li>Complimentary refreshments</li>
            </ul>
            <p style="margin-top: 20px;">We welcome individuals, families, and caregivers. No RSVP required, but feel free to let us know you’re coming.</p>
            <div style="text-align: center; margin-top: 25px;">
              <a href="#" style="background-color: #198754; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block;">RSVP Online</a>
            </div>
          </td>
        </tr>
        <!-- Footer -->
        <tr>
          <td style="padding: 20px; background-color: #e9ecef; text-align: center; font-size: 12px; color: #555;">
            Hosted by MindCare Charity | All are welcome | mindcare.org/events
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

        </section>
    </body>
</html>