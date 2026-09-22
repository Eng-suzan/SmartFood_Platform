<x-app-layout>

    <div class="profile-page">

        <!-- Profile Header -->
        <div class="profile-header">
            <div>
                <span class="profile-badge">MY ACCOUNT</span>
                <h1>Welcome back, {{ Auth::user()->name }} 👋</h1>
                <p>
                    Manage your personal information, password and account settings.
                </p>
            </div>

            <div class="big-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>


        <!-- Profile Information -->
        <div class="profile-card">

            <div class="card-icon">👤</div>

            <div class="card-content">

                @include('profile.partials.update-profile-information-form')

            </div>

        </div>


        <!-- Password -->
        <div class="profile-card">

            <div class="card-icon">🔐</div>

            <div class="card-content">

                @include('profile.partials.update-password-form')

            </div>

        </div>


        <!-- Delete Account -->
        <div class="profile-card danger-card">

            <div class="card-icon">⚠️</div>

            <div class="card-content">

                @include('profile.partials.delete-user-form')

            </div>

        </div>

    </div>


<style>

    /* =========================
       Profile Page
    ========================= */

    .profile-page {
        max-width: 1000px;
        margin: 0 auto;
        padding: 50px 25px 80px;
    }


    /* =========================
       Header
    ========================= */

    .profile-header {
        background: linear-gradient(
            135deg,
            #fff3ed,
            #fff
        );

        border: 1px solid #ffe0d2;

        border-radius: 24px;

        padding: 35px 40px;

        margin-bottom: 25px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        box-shadow: 0 8px 25px rgba(255, 87, 34, 0.06);
    }

    .profile-badge {
        display: inline-block;

        background: #ff5722;
        color: white;

        font-size: 11px;
        font-weight: 700;

        padding: 6px 12px;

        border-radius: 20px;

        letter-spacing: 1px;

        margin-bottom: 12px;
    }

    .profile-header h1 {
        margin: 0;

        font-size: 30px;
        font-weight: 700;

        color: #222;
    }

    .profile-header p {
        margin-top: 8px;

        color: #777;

        font-size: 14px;
    }


    /* =========================
       Big Avatar
    ========================= */

    .big-avatar {
        width: 90px;
        height: 90px;

        border-radius: 50%;

        background: linear-gradient(
            135deg,
            #ff5722,
            #ff8a65
        );

        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 35px;
        font-weight: 700;

        box-shadow: 0 8px 20px rgba(255, 87, 34, 0.25);

        flex-shrink: 0;
    }


    /* =========================
       Cards
    ========================= */

    .profile-card {
        background: white;

        border: 1px solid #eee;

        border-radius: 20px;

        padding: 28px;

        margin-bottom: 20px;

        display: flex;
        gap: 22px;

        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);

        transition: 0.2s;
    }

    .profile-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
        transform: translateY(-1px);
    }


    /* =========================
       Icons
    ========================= */

    .card-icon {
        width: 48px;
        height: 48px;

        border-radius: 14px;

        background: #fff3ed;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 22px;

        flex-shrink: 0;
    }


    /* =========================
       Content
    ========================= */

    .card-content {
        flex: 1;

        max-width: 650px;
    }


    /* =========================
       Delete Card
    ========================= */

    .danger-card {
        border-color: #ffe0e0;
    }

    .danger-card .card-icon {
        background: #fff0f0;
    }


    /* =========================
       Breeze Form Improvements
    ========================= */

    .profile-card label {
        color: #333 !important;
        font-weight: 600;
    }

    .profile-card input {
        border-radius: 10px !important;
    }

    .profile-card button {
        border-radius: 9px !important;
    }


    /* =========================
       Mobile
    ========================= */

    @media (max-width: 768px) {

        .profile-page {
            padding: 25px 15px 50px;
        }

        .profile-header {
            padding: 25px;

            align-items: flex-start;
        }

        .profile-header h1 {
            font-size: 23px;
        }

        .profile-header p {
            font-size: 13px;
        }

        .big-avatar {
            width: 65px;
            height: 65px;

            font-size: 25px;
        }

        .profile-card {
            padding: 20px;

            flex-direction: column;

            gap: 15px;
        }

        .card-icon {
            width: 42px;
            height: 42px;
        }
    }

</style>

</x-app-layout>