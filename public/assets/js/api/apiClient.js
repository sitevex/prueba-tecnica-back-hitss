const BASE_URL = `${window.location.origin}`;
const API_BASE_URL = `${BASE_URL}/api-hitss/ti/v1`;

/**
 * Función para realizar solicitudes al API con soporte para diferentes métodos HTTP.
 * @param {string} url - El endpoint de la API (relativo).
 * @param {Object} data - Los datos a enviar.
 * @param {string} method - El método HTTP (por defecto, GET).
 * @param {Object} headers - Encabezados adicionales (opcional).
 * @returns {Promise<Object>} - La respuesta del servidor en formato JSON.
 */
async function fetchDataFromApi(url, data = {}, method = 'GET', headers = {}) {
    const fullUrl =
        method === 'GET'
            ? `${API_BASE_URL}/${url}?${new URLSearchParams(data)}`
            : `${API_BASE_URL}/${url}`;

    try {
        const response = await fetch(fullUrl, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                ...headers,
            },
            body: method !== 'GET' ? JSON.stringify(data) : null,
        });

        const result = await response.json();

        if (!response.ok) {
            // Retornar un objeto de error controlado con los detalles
            return {
                success: false,
                status: response.status,
                ...result,
            };
        }

        return {
            success: true,
            status: response.status,
            ...result,
        };
    } catch (error) {
        console.error('Error en fetchDataFromApi:', error);
        return {
            success: false,
            status: 500,
            message: 'Error de conexión al servidor',
        };
    }
}