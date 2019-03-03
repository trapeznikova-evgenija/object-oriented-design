#pragma once
#include <iostream>
#include <vector>
#include <algorithm>
#include <climits>
#include <string>
#include "Observer.h"

using namespace std;

struct StationInfo
{
	std::string position;
};

struct SWeatherInfo
{
	double temperature = 0;
	double humidity = 0;
	double pressure = 0;

	StationInfo stationInfo;
};

class CDisplay : public IObserver<SWeatherInfo>
{
private:

	void Update(SWeatherInfo const& data) override
	{
		std::cout << "State Position " << data.stationInfo.position << std::endl;

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
		PrintSensorTypeName("State Position");
		cout << data.stationInfo.position << endl;

		PrintSensorTypeName("Temperature");
		temperature.UpdateStatsData(data.temperature);

		PrintSensorTypeName("Humidity");
		humidity.UpdateStatsData(data.humidity);

		PrintSensorTypeName("Pressure");
		pressure.UpdateStatsData(data.pressure);
	}

	void PrintSensorTypeName(const string& name)
	{
		cout << name << ": " << endl;
	}
};

class CWeatherData : public CObservable<SWeatherInfo>
{
public:

	CWeatherData(const StationInfo& stationInfo)
		: m_stationInfo(stationInfo)
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

	StationInfo GetStationInfo()const
	{
		return m_stationInfo;
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
		info.stationInfo = GetStationInfo();
		info.temperature = GetTemperature();
		info.humidity = GetHumidity();
		info.pressure = GetPressure();
		return info;
	}
private:
	double m_temperature = 0.0;
	double m_humidity = 0.0;
	double m_pressure = 760.0;
	StationInfo m_stationInfo;
};
