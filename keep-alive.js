// Keep-Alive Script for Render.com
// Prevents sleep mode by pinging health endpoint every 4 minutes

const https = require('https');
const http = require('http');

const SITE_URL = process.env.SITE_URL || 'https://softedge.onrender.com';
const HEALTH_ENDPOINT = '/health.php';
const INTERVAL_MINUTES = 4; // Ping every 4 minutes (under Render's 5-minute limit)

function pingHealthEndpoint() {
    const url = new URL(HEALTH_ENDPOINT, SITE_URL);
    const client = url.protocol === 'https:' ? https : http;

    const options = {
        hostname: url.hostname,
        port: url.port,
        path: url.pathname,
        method: 'GET',
        headers: {
            'User-Agent': 'SoftEdge-KeepAlive/1.0',
            'Accept': 'application/json'
        }
    };

    const req = client.request(options, (res) => {
        let data = '';

        res.on('data', (chunk) => {
            data += chunk;
        });

        res.on('end', () => {
            try {
                const health = JSON.parse(data);
                console.log(`[${new Date().toISOString()}] Health check: ${health.status} - Uptime: ${health.uptime}s`);
            } catch (e) {
                console.log(`[${new Date().toISOString()}] Health check response received`);
            }
        });
    });

    req.on('error', (err) => {
        console.error(`[${new Date().toISOString()}] Health check failed:`, err.message);
    });

    req.setTimeout(10000, () => {
        req.destroy();
        console.error(`[${new Date().toISOString()}] Health check timeout`);
    });

    req.end();
}

// Start the keep-alive process
console.log(`Starting SoftEdge Keep-Alive service`);
console.log(`Pinging ${SITE_URL}${HEALTH_ENDPOINT} every ${INTERVAL_MINUTES} minutes`);
console.log(`Press Ctrl+C to stop`);

// Initial ping
pingHealthEndpoint();

// Set up interval
const intervalMs = INTERVAL_MINUTES * 60 * 1000;
setInterval(pingHealthEndpoint, intervalMs);

// Handle graceful shutdown
process.on('SIGINT', () => {
    console.log(`\n[${new Date().toISOString()}] SoftEdge Keep-Alive service stopped`);
    process.exit(0);
});

process.on('SIGTERM', () => {
    console.log(`\n[${new Date().toISOString()}] SoftEdge Keep-Alive service terminated`);
    process.exit(0);
});
