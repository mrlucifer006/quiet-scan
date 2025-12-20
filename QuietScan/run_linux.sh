#!/bin/bash

# Helper script to run QuietScan on Linux

echo "Building Docker image..."
docker compose build

echo "Starting QuietScan..."
echo "Access the application at http://localhost:5000"
docker compose up
