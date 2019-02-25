#pragma once
#include <iostream>
#include <vector>
#include <algorithm>
#include <climits>
#include <string>
#include "Observer.h"

using namespace std;

struct SWeatherInfo
{
	double temperature = 0;
	double humidity = 0;
	double pressure = 0;
	std::string position_name = "";
};

class CDisplay : public IObserver<SWeatherInfo>
{
private:

	void Update(SWeatherInfo const& data) override
	{
		std::cout << "Current Position " << data.position_name << std::endl;
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

		PrintStatsValue();
	}

private:
	void PrintStatsValue()
	{
		cout << "Max " << m_maxValue << endl;
		cout << "Min " << m_minValue << std::endl;
		cout << "Average " << (m_accValue / m_countAcc) << endl;
		cout << "----------------" << endl;
	}

	double m_minValue = numeric_limits<double>::infinity();
	double m_maxValue = -numeric_limits<double>::infinity();
	double m_accValue = 0;
	unsigned m_countAcc = 0;
};

class CStatsDisplay : public IObserver<SWeatherInfo>
{
private:
	CStatsData temperature;
	CStatsData humidity;
	CStatsData pressure;

	void Update(SWeatherInfo const& data) override
	{
		PrintSensorTypeName("Temperature");
		temperature.UpdateStatsData(data.temperature);

		PrintSensorTypeName("Humidity");
		humidity.UpdateStatsData(data.humidity);

		PrintSensorTypeName("Pressure");
		pressure.UpdateStatsData(data.pressure);

		PrintSensorTypeName("Location");
		cout << data.position_name << endl;
	}

	void PrintSensorTypeName(const string& name)
	{
		cout << name << ": " << endl;
	}
};

class CWeatherData : public CObservable<SWeatherInfo>
{
public:

	CWeatherData(const std::string& position_name)
		: m_position_name(position_name)
	{
		
	}

	double GetTemperature()const
	{
		return m_temperature;
	}

	double GetHumidity()const
	{
		return m_humidity;
	}
	
	double GetPressure()const
	{
		return m_pressure;
	}

	std::string GetWeatherDataName()const
	{
		return m_position_name;
	}

	void MeasurementsChanged()
	{
		NotifyObservers();
	}

	void SetMeasurements(double temp, double humidity, double pressure)
	{
		m_humidity = humidity;
		m_temperature = temp;
		m_pressure = pressure;

		MeasurementsChanged();
	}

protected:
	SWeatherInfo GetChangedData() const override
	{
		SWeatherInfo info;
		info.temperature = GetTemperature();
		info.humidity = GetHumidity();
		info.pressure = GetPressure();
		info.position_name = GetWeatherDataName();
		return info;
	}
private:
	double m_temperature = 0.0;
	double m_humidity = 0.0;
	double m_pressure = 760.0;
	std::string m_position_name = "";
};
