<?php
// landing page with modern UI
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MarketingPro – Digital Marketing</title>
  <style>
    body {margin:0; font-family:Arial, sans-serif; color:#222; background:#f9f9f9;}
    header {width:100%; background:white; padding:18px 40px; display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #e5e5e5; position:sticky; top:0; z-index:1000; box-sizing:border-box;}
    nav a {margin-left:24px; text-decoration:none; color:#333; font-size:16px; transition:0.3s;} nav a:hover {color:#007bff;}

    .hero {padding:120px 40px; text-align:center; background:white;}
    .hero h2 {font-size:48px; font-weight:700; margin-bottom:18px; color:#111;}
    .hero p {font-size:19px; color:#555; max-width:700px; margin:0 auto 35px auto; line-height:1.6;}
    .button {padding:15px 38px; font-size:17px; border-radius:8px; background:#007bff; color:white; text-decoration:none;} .button:hover {background:#005fcc;}

    .features {display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:25px; padding:70px 40px;}
    .card {background:white; padding:30px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.05); transition:0.2s;} .card:hover {box-shadow:0 6px 16px rgba(0,0,0,0.08); transform:translateY(-3px);} 
    .card h3 {font-size:20px; margin-bottom:10px; font-weight:600;} .card p {color:#666; font-size:15px;}

    #contact {padding:70px 40px; background:white;}
    #contact form {max-width:600px; margin:0 auto; display:flex; flex-direction:column; gap:18px;}
    #contact input, #contact textarea {padding:14px; border:1px solid #ddd; border-radius:6px; font-size:15px;}
    #contact button {padding:14px; background:#007bff; color:white; border:none; font-size:16px; border-radius:6px; cursor:pointer;} #contact button:hover {background:#005fcc;}

    footer {text-align:center; padding:25px; background:white; border-top:1px solid #e5e5e5; margin-top:50px; font-size:14px; color:#777;}
    /* Success Toast */
    .toast {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #28a745;
      color: white;
      padding: 15px 22px;
      border-radius: 8px;
      font-size: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      opacity: 0;
      transform: translateY(-20px);
      pointer-events: none;
      transition: opacity 0.4s ease, transform 0.4s ease;
      z-index: 9999;
    }

    .toast.show {
      opacity: 1;
      transform: translateY(0);
    } 
  </style>
  
</head>
<body>
<?php if (isset($_GET['success'])): ?>
  <div class="toast" id="toast">Message sent successfully!</div>
<?php endif; ?>
<header>
  <h1 style="font-size:22px; font-weight:700; margin:0;">MarketingPro</h1>
  <nav>
    <a href="#home">Home</a>
    <a href="login.php">Login</a>
    <a href="#contact">Contact</a>
  </nav>
</header>

<section class="hero" id="home">
  <h2>Smart Digital Marketing That Actually Works</h2>
  <p>Launch campaigns, collect high-quality leads, and track performance using a fast, clean and modern dashboard.</p>
  <a href="register.php" class="button">Get Started</a>
</section>

<section class="features">
  <div class="card">
    <h3>Campaign Management</h3>
    <p>Create, publish and monitor marketing campaigns with ease.</p>
  </div>

  <div class="card">
    <h3>Lead Collection</h3>
    <p>Collect potential customers, store details and manage audiences smoothly.</p>
  </div>

  <div class="card">
    <h3>Analytics Dashboard</h3>
    <p>Track reach, engagement and performance using clean visual insights.</p>
  </div>
</section>

<section id="contact">
  <h2 style="text-align:center; font-size:32px; font-weight:700; margin-bottom:25px;">Contact Us</h2>
  <form action="contact_submit.php" method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
    <button type="submit" name="send">Send Message</button>
</form> 
</section>

<footer>
  © 2025 MarketingPro. All rights reserved.
</footer>
<script>
  const toast = document.getElementById("toast");
  if (toast) {
    setTimeout(() => {
      toast.classList.add("show");
    }, 200);

    setTimeout(() => {
      toast.classList.remove("show");
    }, 3000);
  }
</script>
</body>
</html>