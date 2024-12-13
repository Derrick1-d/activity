import pandas as pd
from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/import', methods=['POST'])
def import_excel():
    file = request.files['file']
    try:
        # Read the Excel file
        df = pd.read_excel(file)
        # Convert the data to JSON for Laravel
        data = df.to_dict(orient='records')
        return jsonify({'status': 'success', 'data': data})
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 400

if __name__ == "__main__":
    app.run(debug=True)
