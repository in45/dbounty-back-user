# DBounty User Backend

## Overview

The **DBounty User Backend** is the server-side application for the DBounty platform, built with Laravel. It handles backend operations for vulnerability researchers (bounty hunters), including user authentication, report submission, and interaction with smart contracts. This backend ensures secure and efficient management of user data, report processing, and communication with Ethereum smart contracts.

## Features

- **User Authentication:** Secure authentication using JWT with RSA Algorithm.
- **Report Management:** Handle the creation, validation, and processing of vulnerability reports.
- **Smart Contract Interaction:** Interface with Ethereum smart contracts to manage platform functionalities.
- **Real-Time Communication:** Support for WebSocket communication for instant updates and chat functionalities.
- **Email Notifications:** Manage email notifications using Laravel's Mailable class.

## Application Structure

The User Backend is organized into:

- **Controllers:** Manage HTTP requests and responses.
- **Models:** Define and interact with database entities.
- **Services:** Implement business logic and interact with smart contracts.
- **Middleware:** Handle request filtering and authentication.
- **Routes:** Define API endpoints for frontend communication.

## Authentication

- **Method:** JSON Web Token (JWT) with RSA Algorithm.
- **Details:** JWT is used to secure API requests. The token is issued after user authentication via MetaMask and is required for accessing protected endpoints.

## Real-Time Communication

- **Protocol:** WebSocket.
- **Usage:** Used for real-time updates on report status and chat messages between users and company managers.

## Email System

- **Framework:** Laravel's Mailable class.
- **Usage:** Sends notifications to users regarding report status changes and other platform-related updates.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.


