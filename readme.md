<p align="center">
  <img src="Images/Logo.PNG" width="300" alt="Project BUXS Logo"/>
</p>

# Project BUXS – Browser User eXfiltration System

> **"What if your browser was the weakest link?"**

**Project BUXS** is a hands-on offensive security lab designed to demonstrate how browser-based attacks like **GET header manipulation**, **Cross-Site Scripting (XSS) cookie hijacking**, and **SQL injections (SQLi)** can be used to pivot across **two interconnected webservers**. 

Set at a fictional deployment hosted through *Charleston Southern University*, this lab gives students and red teamers the opportunity to simulate real-world browser attack vectors in a controlled environment.
Users can also set up their own instance for others to play and attempt to progress through the exploits and delve into the Lumino corporation.

---

## What You'll Learn

Project BUXS teaches you how to:

- **Manipulate GET headers** to bypass filters and extract unintended responses.
- **Perform XSS attacks** that exfiltrate browser cookies and tokens to an attacker-controlled endpoint.
- **Execute SQL injections** on weak login forms and comment systems to reveal sensitive data.
- **Move laterally** between two webservers that trust each other, exploiting session cookies and poorly validated user input.

---

## Lab Structure

The lab includes two vulnerable webservers:

| Server | Description |
|--------|-------------|
| `webserver-1` | Public-facing site vulnerable to GET header tricks and file inclusion |
| `webserver-2` | Public-facing site visable after finding a hidden file and uses stored XSS and SQLi |

Both sites are containerized and ready to spin up via Docker or directly on local Apache/Nginx + PHP setups.

---

## Files Included

Once you clone this repo, you'll get:

- `webserver-1` – Codebase for the first target with exploitable query parameters and input sinks
- `webserver-2` – Internal admin panel used for cookie-based auth
- `Project-BUXS-Guide.pdf` *(coming soon)* – Full walkthrough & instructor notes
---

## Getting Started

### Prerequisites
- Virtualization (ESXi or Virtualbox. Docker is possible)
- PHP + Apache
- Basic networking knowledge

### Setup Instructions

1. Download the source files.
2. Create a VM/docker/device to host the websites
3. Install Apache2 and PHP on both webservers and mariadb, python3, and php-mysql on webserver2
4. Use the folders to replace the /var/www/html/ folder
5. Change Flint.txt (the secret file) contents to point to your second webserver
6. Create a database called lumino_db
7. Import the sqldump into the lumino_db database
8. Create a new SQL user called lumino_user and edit the config.php file to the password (needed to make SQL queries)
9. Run the python XSS checker
10. Have fun

### Ethical Disclaimer

This project is intended **strictly for educational use** in penetration testing labs, CTF environments, or controlled training simulations. Do not deploy this code in any production environment.

### Credits

Project BUXS was developed for instructional use at Charleston Southern University, and is maintained by Jared Andraszek.
The logo was created by Charlotte Strobl

### Want to contribute?

I am always looking for more exploits to add to the project and create a more intertwined exploitable learning environment. If you have any additions or patches, open a pull request with your own attack chains, patches, or visualizations. All enhancements welcome. Just make sure they follow the BUXS ethos of **teaching offensive security with a purpose.**

