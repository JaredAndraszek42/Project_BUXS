<p align="center">
  <img src="Lumino-Logo-Full.PNG" width="300" alt="Project BUXS Logo"/>
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
- 
---

## 🛠️ Getting Started

### Prerequisites
- Virtualization (ESXi or Virtualbox. Docker is possible)
- PHP + Apache
- Basic networking knowledge

### Setup Instructions


