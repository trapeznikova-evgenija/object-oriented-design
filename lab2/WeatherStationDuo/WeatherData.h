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
};

typedef std::pair<std::string, SWeatherInfo> WeatherDataInfo;

class CDisplay : public IObserver<WeatherDataInfo>
{
private:

	void Update(const WeatherDataInfo& data) override
	{
		std::cout << "State Position " << data.first << std::endl;

		std::cout << "Current Temp " << data.second.temperature << std::endl;
		std::cout << "Current Hum " << data.second.humidity << std::endl;
		std::cout << "Current Pressure " << data.second.pressure << std::endl;
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

class CStatsDisplay : public IObserver<WeatherDataInfo>
{
private:
	CStatsData m_temperature;
	CStatsData m_humidity;
	CStatsData m_pressure;

	void Update(const WeatherDataInfo& data) override
	{
		PrintSensorTypeName("State Position");
		cout << data.first << endl;

		PrintSensorTypeName("Temperature");
		m_temperature.UpdateStatsData(data.second.temperature);

		PrintSensorTypeName("Humidity");
		m_humidity.UpdateStatsData(data.second.humidity);

		PrintSensorTypeName("Pressure");
		m_pressure.UpdateStatsData(data.second.pressure);
	}

	void PrintSensorTypeName(const string& name)
	{
		cout << name << ": " << endl;
	}
};

class CWeatherData : public CObservable<WeatherDataInfo>
{
public:

	CWeatherData(const string& location)
		: m_stationLocation(location)
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

	std::string GetStationLocation()const
	{
		return m_stationLocation;
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
	WeatherDataInfo GetChangedData() const override
	{
		WeatherDataInfo info;
		info.first = GetStationLocation();
		info.second.temperature = GetTemperature();
		info.second.humidity = GetHumidity();
		info.second.pressure = GetPressure();
		return info;
	}
private:
	double m_temperature = 0.0;
	double m_humidity = 0.0;
	double m_pressure = 760.0;
	std::string m_stationLocation;
};
