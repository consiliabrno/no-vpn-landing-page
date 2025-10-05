import { NextResponse } from 'next/server';

const REDIRECT_HOST = 'https://consilia-brno.com';
const PUBLIC_HOST = 'consilia.cz';

export function middleware(request) {
    // Get the hostname from the request headers.
    const host = request.headers.get('host');

    // If the host is the 2nd level public domain (consilia.cz),
    // redirect to the specified external URL.
    if (host === PUBLIC_HOST) {
        return NextResponse.redirect(REDIRECT_HOST);
    }

    // For any other host (like <machine>.consilia.cz),
    // allow the request to proceed, which will show index.html page.
    return NextResponse.next();
}

// Configures the middleware to run on all incoming requests.
export const config = {
    matcher: '/:path*',
};
