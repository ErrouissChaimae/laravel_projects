<!-- resources/views/auth/login.blade.php -->
<div >
    <h2 contenteditable="true" class="pr">pieces auto</h2>
</div>
<div class="box">
    <span class="borderLine"></span>
<form method="POST" action="{{ url('/login') }}">
    <h2>connection:</h2>
    @csrf
    <div class="inputBox">
    <input type="email" name="email"  required>
   <span>user</span> 
   <i></i>
    </div>
    <div class="inputBox" >
    <input type="password" name="password" required>
    <span>password</span>
    <i></i>
</div>
<input type="submit" value="login">
   <div class="links"> 
    <a href="{{ route('homes.create') }}" style="text-decoration: underline; ">s'inscrire</a>
</div>
</form>
@if(session('error'))
    <p>{{ session('error') }}</p>
@endif
</div>

    

<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background:#080808;
    background-size: cover;
    background-position: center;
}

.box {
    position: relative;
    width: 380px;
    height: 462px;
    background: #1c1c1c;
    border-radius: 8px;
    overflow: hidden;
}

.box::before,
.box::after,
.borderLine::before,
.borderLine::after {
    content: '';
    position: absolute;
    top: -50%;
    width: 380px;
    height: 462px;
    z-index: 1;
    transform-origin: bottom right;
    animation: animate 6s linear infinite;
}

.box::before,
.box::after {
    background: linear-gradient(0deg, transparent, transparent, #f40303, #d30707, #d30707);
}

.borderLine::before,
.borderLine::after {
    background: linear-gradient(0deg, transparent, transparent, #f40303, #9c0010, #552a2e);
}

.box::before {
    animation-delay: 0s;
}

.box::after {
    animation-delay: -3s;
}

.borderLine::before {
    animation-delay: -1.5s;
}

.borderLine::after {
    animation-delay: -4.5s;
}

@keyframes animate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.box form {
    position: absolute;
    inset: 4px;
    background: #020202;
    padding: 50px 40px;
    z-index: 2;
    display: flex;
    flex-direction: column;
}

.box form h2 {
    color: #fff;
    font-weight: 500;
    text-align: center;
    letter-spacing: 0.1em;
}

.box form .inputBox {
    position: relative;
    width: 100%;
    margin-top: 35px;
}

.box form .inputBox input {
    position: relative;
    width: 100%;
    padding: 20px 10px 10px;
    background: transparent;
    outline: none;
    border: none;
    box-shadow: none;
    color: #23242a;
    font-size: 1em;
    letter-spacing: 0.05em;
    transition: 0.5s;
    z-index: 10;
}

.box form .inputBox span {
    position: absolute;
    left: 0;
    padding: 20px 0px 10px;
    pointer-events: none;
    color: #8f8f8f;
    font-size: 1em;
    letter-spacing: 0.05em;
    transition: 0.5s;
}

.box form .inputBox input:valid~span,
.box form .inputBox input:focus~span {
    color: #fff;
    font-size: 0.75em;
    transform: translateY(-34px);
}

.box form .inputBox i {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background: #fff;
    border-radius: 4px;
    overflow: hidden;
    transition: 0.5s;
    pointer-events: none;
}

.box form .inputBox input:valid~i,
.box form .inputBox input:focus~i {
    height: 44px;
}

.box form .links {
    display: flex;
    justify-content: space-between;
}

.box form .links a {
    margin: 10px 0;
    font-size: 0.75em;
    color: #8f8f8f;
    text-decoration: none;
}

.box form .links a:hover,
.box form .links a:nth-child(2) {
    color: #fff;
}

.box form input[type="submit"] {
    border: none;
    outline: none;
    padding: 9px 25px;
    background: #fff;
    cursor: pointer;
    font-size: 0.9em;
    border-radius: 4px;
    font-weight: 600;
    width: 100px;
    margin-top: 10px;
}

.box form input[type="submit"]:active {
    opacity: 0.8;
}

/*css de texte*/
.pr{
  position: relative;
  font-size: 6em;
  letter-spacing: 15px;
  color: #0e3742;
  text-transform: uppercase;
  width: 100%;
  text-align: center;
  -webkit-box-reflect:below 1px linear-gradient(transparent,#0008);
  line-height: 0.70em;
  outline: none;
  animation: animate 5s linear infinite;
  justify-content: center;
  align-items: center;
}
@keyframes animate
{
  0%,18%,20%,50.1%,60%,65.1%,80%,90.1%,92%
  {
    color: #080808;
    text-shadow: none;
  }
  10.1%,20.1%,30%,50%,60.1%,65%,80.1%,90%,92.1%,100%
  {
    color:#080808;
    text-shadow:  0 0 10px #f40303,
    0 0 20px #f40303,
    0 0 40px #f40303,
    0 0 80px #f40303,
    0 0 160px #f40303;
  }
}




</style>