import React, { useEffect, useState } from 'react';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import 'leaflet-routing-machine';
import 'leaflet-routing-machine/dist/leaflet-routing-machine.css';

interface Friend {
    id: number;
    name: string;
    lat: number;
    lng: number;
}

export default function MapApp() {
    const [map, setMap] = useState<L.Map | null>(null);
    const [selfMarker, setSelfMarker] = useState<L.Marker | null>(null);
    const [routingControl, setRoutingControl] = useState<L.Routing.Control | null>(null);

    // Hardcoded vrienden
    const friends: Friend[] = [
        { id: 1, name: 'Alice', lat: 51.845, lng: 5.852 },
        { id: 2, name: 'Bob', lat: 51.840, lng: 5.860 },
        { id: 3, name: 'Charlie', lat: 51.850, lng: 5.855 },
    ];

    // Init map
    useEffect(() => {
        if (!map) {
            const newMap = L.map('map').setView([51.8425, 5.8528], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(newMap);
            setMap(newMap);
        }
    }, [map]);

    // Update own location
    useEffect(() => {
        if (!map) return;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                const { latitude, longitude } = pos.coords;

                if (!selfMarker) {
                    const marker = L.marker([latitude, longitude])
                        .addTo(map)
                        .bindPopup('Jij')
                        .openPopup();
                    setSelfMarker(marker);
                } else {
                    selfMarker.setLatLng([latitude, longitude]);
                }

                map.setView([latitude, longitude], 13);
            });
        }
    }, [map, selfMarker]);

    // Alert knop: toon route naar een vriend
    const sendAlert = (friend: Friend) => {
        if (!map || !selfMarker) return;

        const { lat, lng } = selfMarker.getLatLng();

        // Voeg vriend toe als marker
        L.marker([friend.lat, friend.lng]).addTo(map).bindPopup(friend.name).openPopup();

        // Verwijder vorige route als die er is
        if (routingControl) {
            map.removeControl(routingControl);
        }

        // Voeg nieuwe wandelroute toe
        // @ts-ignore
        const control = L.Routing.control({
            waypoints: [L.latLng(lat, lng), L.latLng(friend.lat, friend.lng)],
            lineOptions: { styles: [{ color: 'green', opacity: 0.7, weight: 5 }] },
            routeWhileDragging: false,
            addWaypoints: false,
            router: L.Routing.osrmv1({ profile: 'foot' }), // voetgangersroute
        }).addTo(map);

        setRoutingControl(control);
    };

    return (
        <div className="flex h-screen">
            {/* Sidebar met buttons */}
            <div className="w-64 p-4 bg-white shadow-lg flex-shrink-0">
                <h2 className="text-xl font-bold mb-4">Vrienden</h2>
                <div className="space-y-2">
                    {friends.map(f => (
                        <button
                            key={f.id}
                            className="w-full flex items-center justify-between px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-200"
                            onClick={() => sendAlert(f)}
                        >
                            <span>{f.name}</span>
                            <span className="text-sm">🚶‍♂️</span>
                        </button>
                    ))}
                </div>
            </div>

            {/* Kleinere kaart */}
            <div className="flex-1">
                <div id="map" className="w-full h-full rounded-lg overflow-hidden"></div>
            </div>
        </div>
    );
}
