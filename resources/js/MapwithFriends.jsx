import React, { useEffect, useState } from "react";
import { MapContainer, TileLayer, Marker, Popup } from "react-leaflet";
import { db, ref, onValue } from "./firebase";
import "leaflet/dist/leaflet.css";

const MapWithFriends = () => {
    const [locations, setLocations] = useState({});

    useEffect(() => {
        // Haal locaties op vanuit Firebase
        const locationRef = ref(db, "locations");
        onValue(locationRef, (snapshot) => {
            setLocations(snapshot.val() || {});
        });
    }, []);

    return (
        <MapContainer center={[51.505, -0.09]} zoom={13} style={{ height: "100vh", width: "100%" }}>
            <TileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />

            {/* Toon markers voor elke vriend */}
            {Object.entries(locations).map(([userId, location]) => (
                <Marker key={userId} position={[location.latitude, location.longitude]}>
                    <Popup>
                        <strong>Vriend ID:</strong> {userId}<br />
                        <strong>Latitude:</strong> {location.latitude}<br />
                        <strong>Longitude:</strong> {location.longitude}
                    </Popup>
                </Marker>
            ))}
        </MapContainer>
    );
};

export default MapWithFriends;
