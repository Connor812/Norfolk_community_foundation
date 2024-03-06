// Specify the path to the.env file
export async function getEnvVariables() {

    const envFilePath = '.env';

    try {
        // Fetch the .env file
        const response = await fetch(envFilePath);
        const envFileContent = await response.text();

        // Parse the .env file
        const envVariables = envFileContent.split('\n').reduce((acc, line) => {
            const [key, value] = line.split('=');
            if (key && value) {
                acc[key.trim()] = value.trim();
            }
            return acc;
        }, {});

        return {
            "username": envVariables.USERNAME,
            "password": envVariables.PASSWORD
        };
    } catch (error) {
        console.error('Error loading .env file:', error);
    }
}

export async function getToken(username, password) {
    try {

        const basicAuth = btoa(`${username}:${password}`);

        const response = await fetch("https://api-m.sandbox.paypal.com/v1/oauth2/token", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Authorization': `Basic ${basicAuth}`
            },
            body: 'grant_type=client_credentials'
        });

        const tokenInfo = await response.json();

        if (tokenInfo.access_token) {
            return tokenInfo.access_token;
        } else {
            console.error('Error getting access token:', tokenInfo);
            return null;
        }
    } catch (error) {
        console.error('Error getting access token:', error);
        return null;
    }
}