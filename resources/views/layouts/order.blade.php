<!DOCTYPE html>
<html>
<head>
    <title>Order Note Board</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 40px;
            color: #111827;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
        }

        .header p {
            color: #64748b;
            font-size: 18px;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            box-sizing: border-box;
        }

        textarea {
            height: 120px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 14px;
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #4338ca;
        }

        .note {
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 0;
        }

        .note:last-child {
            border-bottom: none;
        }

        .order-number {
            color: #4f46e5;
            font-weight: bold;
            font-size: 18px;
        }

        .meta {
            color: #64748b;
            font-size: 14px;
            margin-top: 5px;
        }

        .message {
            margin-top: 8px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Order Note Board</h1>
</div>

<div class="container">
    <div class="card">
        <h2>Add New Note</h2>

        <form id="noteForm">
            <label>Order Number</label>
            <input type="text" id="order_number" placeholder="e.g. ORD-1042" required>

            <label>Author</label>
            <input type="text" id="author" placeholder="Your name" required>

            <label>Message</label>
            <textarea id="message" placeholder="Write your note here..." required></textarea>

            <button type="submit">Add Note</button>
        </form>
    </div>

    <div class="card">
        <h2>Recent Notes</h2>
        <div id="notesList"></div>
    </div>
</div>

<script>
    const notesList = document.getElementById('notesList');
    const noteForm = document.getElementById('noteForm');

    async function loadNotes() {
        const response = await fetch('/api/notes');
        const notes = await response.json();

        notesList.innerHTML = '';

        if (notes.length === 0) {
            notesList.innerHTML = '<p>No notes yet.</p>';
            return;
        }

        notes.forEach(note => {
            const noteDiv = document.createElement('div');
            noteDiv.classList.add('note');

            const date = new Date(note.created_at).toLocaleString();

            noteDiv.innerHTML = `
                    <div class="order-number">${note.order_number}</div>
                    <div class="message">${note.message}</div>
                    <div class="meta">By ${note.author} • ${date}</div>
                `;

            notesList.appendChild(noteDiv);
        });
    }

    noteForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const data = {
            order_number: document.getElementById('order_number').value,
            author: document.getElementById('author').value,
            message: document.getElementById('message').value
        };

        await fetch('/api/notes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        noteForm.reset();
        loadNotes();
    });

    loadNotes();
</script>

</body>
</html>
