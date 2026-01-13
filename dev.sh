#!/bin/bash

# SoftEdge Corporation - Development Script
# This script sets up the development environment for React integration

echo "🚀 Starting SoftEdge Corporation Development Environment"
echo "======================================================"

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js first."
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "❌ npm is not installed. Please install npm first."
    exit 1
fi

echo "✅ Node.js version: $(node --version)"
echo "✅ npm version: $(npm --version)"

# Install dependencies
echo ""
echo "📦 Installing dependencies..."
npm install

if [ $? -ne 0 ]; then
    echo "❌ Failed to install dependencies"
    exit 1
fi

echo "✅ Dependencies installed successfully"

# Build React app
echo ""
echo "🔨 Building React application..."
npm run build

if [ $? -ne 0 ]; then
    echo "❌ Failed to build React application"
    exit 1
fi

echo "✅ React application built successfully"

# Start development server (optional)
echo ""
echo "💡 Development environment ready!"
echo ""
echo "To start the development server, run:"
echo "  npm run dev"
echo ""
echo "To build for production:"
echo "  npm run build"
echo ""
echo "The built files are in the 'dist/' directory and can be served by your PHP application."
