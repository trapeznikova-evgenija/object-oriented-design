#pragma once
#include <iostream>
#include <vector>
#include <algorithm>
#include <climits>
#include <string>
#include "Observer.h"
#define _USE_MATH_DEFINES
#include <math.h>

using namespace std;

struct SWeatherInfo
{
	double temperature = 0;
	double humidity = 0;
	double pressure = 0;
	double windSpeed = 0;
	double direction = 0;
};

class CDisplay : public IObserver<SWeatherInfo>
{
private:
	void Update(SWeatherInfo const& data) override
	{
		std::cout << "Current Wind Speed " << data.windSpeed << std::endl;
		std::cout << "Current Wind Direction " << data.direction << std::endl;
		std::cout << "Current Temp " << data.temperature << std::endl;
		std::cout << "Current Hum " << data.humidity << std::endl;
		std::cout << "Current Pressure " << data.pressure << std::endl;
		std::cout << "----------------" << std::endl;
	}
};

class CStatsData
{
public:
	void UpdateStatsData(const double sensorType)
	{
		if (m_minValue > sensorType)
		{
			m_minValue = sensorType;
		}
		if (m_maxValue < sensorType)
		{
			m_maxValue = sensorType;
		}
		m_accValue += sensorType;
		++m_countAcc;
		m_averageValue = m_accValue / m_countAcc;
		
		PrintStatsValue();
	}

private:
	void PrintStatsValue()
	{
		cout << "Max " << m_maxValue << endl;
		cout << "Min " << m_minValue << std::endl;
		cout << "Average " << m_averageValue << endl;
		cout << "----------------" << endl;
	}

	double m_minValue = numeric_limits<double>::infinity();
	double m_maxValue = -numeric_limits<double>::infinity();
	double m_accValue = 0;
	double m_averageValue = 0;
	unsigned m_countAcc = 0;
};

class CAverageWindDirection
{
public:
	double GetAverageWindDirection()const
	{
		return atan2(m_yCoord / m_countAcc, m_xCoord / m_countAcc) * (180 / M_PI);
	}

	void UpdateAverageWindDirection(const double degree, const double speed)
	{
		double x = cos(degree * M_PI / 180) * speed;
		double y = sin(degree * M_PI / 180) * speed;

		++m_countAcc;

		m_xCoord += x;
		m_yCoord += y;
	}

private:
	double m_xCoord = 0;
	double m_yCoord = 0;
	unsigned m_countAcc = 0;
};

class CStatsDisplay : public IObserver<SWeatherInfo>
{
private:
	CStatsData m_temperature;
	CStatsData m_humidity;
	CStatsData m_pressure;
	CStatsData m_windSpeed;
	CAverageWindDirection m_windDirection;

	void Update(SWeatherInfo const& data) override
	{
		PrintSensorTypeName("Temperature");
		m_temperature.UpdateStatsData(data.temperature);

		PrintSensorTypeName("Humidity");
		m_humidity.UpdateStatsData(data.humidity);

		PrintSensorTypeName("Pressure");
		m_pressure.UpdateStatsData(data.pressure);

		PrintSensorTypeName("Wind Speed");
		m_windSpeed.UpdateStatsData(data.windSpeed);

		PrintSensorTypeName("Wind Direction");
		m_windDirection.UpdateAverageWindDirection(data.direction, data.windSpeed);
		cout << "Average " << m_windDirection.GetAverageWindDirection() << endl;
		cout << "----------------" << endl;
	}

	void PrintSensorTypeName(const string& name)
	{
		cout << name << ": " << endl;
	}
};

class CWeatherData : public CObservable<SWeatherInfo>
{
public:
	// ����������� � �������� �������
	double GetTemperature()const
	{
		return m_temperature;
	}
	// ������������� ��������� (0...100)
	double GetHumidity()const
	{
		return m_humidity;
	}
	// ����������� �������� (� ��.��.��)
	double GetPressure()const
	{
		return m_pressure;
	}

	double GetWindSpeed()const
	{
		return m_windSpeed;
	}

	double GetWindDirection()const
	{
		return m_direction;
	}

	void MeasurementsChanged()
	{
		NotifyObservers();
	}

	void SetMeasurements(double temp, double humidity, double pressure, double windSpeed, double direction)
	{
		m_humidity = humidity;
		m_temperature = temp;
		m_pressure = pressure;
		m_direction = direction;
		m_windSpeed = windSpeed;

		MeasurementsChanged();
	}
protected:
	SWeatherInfo GetChangedData() const override	
	{
		SWeatherInfo info;
		info.temperature = GetTemperature();
		info.humidity = GetHumidity();
		info.pressure = GetPressure();
		info.windSpeed = GetWindSpeed();
		info.direction = GetWindDirection();
		return info;
	}
private:
	double m_temperature = 0.0;
	double m_humidity = 0.0;
	double m_pressure = 760.0;
	double m_windSpeed = 0;
	double m_direction = 0;
};
