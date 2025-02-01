from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from datetime import datetime

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///applications.db'
db = SQLAlchemy(app)

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(50), nullable=False)
    password = db.Column(db.String(255), nullable=False)

class Application(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)
    status = db.Column(db.String(50), nullable=False)
    created_at = db.Column(db.DateTime, default=datetime.utcnow)
    updated_at = db.Column(db.DateTime, default=datetime.utcnow, onupdate=datetime.utcnow)

@app.route('/applications', methods=['POST'])
def create_application():
    data = request.json
    new_application = Application(user_id=data['user_id'], status='submitted')
    db.session.add(new_application)
    db.session.commit()
    return jsonify({'id': new_application.id, 'status': new_application.status}), 201

@app.route('/applications/<int:id>', methods=['GET'])
def get_application(id):
    application = Application.query.get_or_404(id)
    return jsonify({'id': application.id, 'user_id': application.user_id, 'status': application.status})

@app.route('/applications/<int:id>/status', methods=['PUT'])
def update_status(id):
    data = request.json
    application = Application.query.get_or_404(id)
    application.status = data['status']
    db.session.commit()
    return jsonify({'id': application.id, 'status': application.status})

if __name__ == '__main__':
    with app.app_context():
        db.create_all()
    app.run(debug=True)

